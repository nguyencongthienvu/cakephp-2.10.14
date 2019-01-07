<?php
App::uses('Controller', 'Controller');
    class AuthLoginController extends AppController {
        var  $helpers = array('Html', 'Form', 'Session');

        public function beforeFilter() {
          $this->Auth->allow('fb_login');
        }

        public function login() {
            if ($this->request->is('post')) {
                $data = $this->request->data;
                if ($data['AuthLogin']) {
                  $query = $this->AuthLogin->getDataById($data['AuthLogin']['email'], $data['AuthLogin']['password']);
                    if ($query) {
                      if ($this->isAuthorized($query['AuthLogin'])) {
                        $this->Auth->login($data['AuthLogin']);
                        if ($this->Auth->login()) {
                          $this->Session->write("Token", "Tokens");
                          $this->Session->write("Id",$query['AuthLogin']['id']);
                          return $this->redirect($this->Auth->redirectUrl());
                        } else {
                          echo $this->Session->setFlash('Cant log in please check your internet or try again.'
                        ,'default',array(),'authlogin');
                        }
                      } else {
                        echo $this->Session->setFlash('You are not authorized to access that location.'
                        ,'default',array(),'authlogin');
                      }           
                    } else {
                      echo $this->Session->setFlash('Invalid username or password, try again',
                      'default',array(),'authlogin');
                    }
                } else {
                    echo  $this->Session->setFlash("Username or Password missing.Please try again !" ,'default',array(),'authlogin');
                }
            }
        }

        public function fb_login() {
          $config = Configure::read('Facebook_Login');
          $fb = new Facebook\Facebook([
            'app_id' => $config['app-id'],
            'app_secret' => $config['secrect'],
            'default_graph_version' => $config['graphql-version'],
            ]);
          
          $helper = $fb->getRedirectLoginHelper();
          
          try {
            if (isset($_GET['state'])) { $helper->getPersistentDataHandler()->set('state', $_GET['state']); }
            $accessToken = $helper->getAccessToken();
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            var_dump($helper->getError());
            exit;
          }
          
          if (! isset($accessToken)) {
            if ($helper->getError()) {
              header('HTTP/1.0 401 Unauthorized');
              echo "Error: " . $helper->getError() . "\n";
              echo "Error Code: " . $helper->getErrorCode() . "\n";
              echo "Error Reason: " . $helper->getErrorReason() . "\n";
              echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
              header('HTTP/1.0 400 Bad Request');
              echo 'Bad request';
            }
            exit;
          }
          
          // Logged in
          
          // The OAuth 2.0 client handler helps us manage access tokens
          $oAuth2Client = $fb->getOAuth2Client();
          
          // Get the access token metadata from /debug_token
          $tokenMetadata = $oAuth2Client->debugToken($accessToken);
          
          // Validation (these will throw FacebookSDKException's when they fail)
          $tokenMetadata->validateAppId($config['app-id']);
          // If you know the user ID this access token belongs to, you can validate it here
          //$tokenMetadata->validateUserId('123');
          $tokenMetadata->validateExpiration();
          
          if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
              $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
              echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
              exit;
            }
          }
          
          $_SESSION['fb_access_token'] = (string) $accessToken;

          try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $user = $response->getGraphUser();
          $this->Session->write("Token", "Tokens");
          $data_user = $this->AuthLogin->getDataByFacebookId($user['id'], $_SESSION['fb_access_token']);
          if ($data_user && $this->isAuthorized($data_user['AuthLogin'])) {
            $this->Auth->login($data_user['AuthLogin']);
            if ($this->Auth->login()) {
              $this->Session->write("Token", "Tokens");
              $this->Session->write("Id", $data_user['AuthLogin']['id']);
              $this->Session->write("Image", $data_user['AuthLogin']['picture_url']);
              return $this->redirect($this->Auth->redirectUrl());
            }
          } else {
              $data = array(
                  'username' => $user['name'], 
                  'email' => $user['email'],
                  'access_token' => $_SESSION['fb_access_token'],
                  'facebook_id' => $user['id'],
                  'role' => '1',
                  'picture_url' => $user['picture']['url']);
              $data_user = $this->AuthLogin->save($data);
              if ($data_user && $this->isAuthorized($data_user['AuthLogin'])) {
                $this->Auth->login($data_user['AuthLogin']);
                if ($this->Auth->login()) {
                  $this->Session->write("Id", $data_user['AuthLogin']['id']);
                  $this->Session->write("Token", "Token");
                  return $this->redirect($this->Auth->redirectUrl());
                }
              } 
          }
        }

        public function isAuthorized($user) {
          // Admin can access every action
          if (isset($user['role']) && $user['role'] === '1') {
              return true;
          } else {
            return false;
          }
          // Default deny
        }
    }
?>