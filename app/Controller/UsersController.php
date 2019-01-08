<?php
    class UsersController extends AppController {
        var  $helpers = array('Html', 'Form', 'Session');

        public function profile() {
            if ($this->Session->read("Id")) {
                $id = $this->Session->read("Id");
                $query = $this->User->getDataById($id);
                if ($query) {
                    $this->set("user_profile", $query);
                } else {
                    $this->Session->destroy();
                    return $this->redirect(array('controller' => 'authlogin', 'action' => 'login'));
                }
            }
        }

        public function Back() {
            $this->redirect($this->Auth->redirectUrl());
        }
        public function logout() {
            $this->Session->destroy();
            return $this->redirect(array('controller' => 'authlogin', 'action' => 'login'));
        }
        public function index() {
            $this->paginate = $this->User->getAllData();
            $data = $this->paginate('User');
            $this->set('users', $data);
        }

        public function detail($id) {
            if ($id) {
                $query = $this->User->getDataById($id);
                if ($query) {
                    $this->set("user", $query);
                }
            } else {
                throw new NotFoundException(__('Invalid user'));
            }
        }

        public function themuser() {
            if ($this->request->is('post')) {
                if ($this->request->data) {
                    $query = $this->User->addData($this->request->data);
                    if ($query === "success") {
                        $this->Flash->success($query);
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Flash->error($query);
                    }
                
                } else {
                    $this->Flash->error("Missing field");
                }
            }
        }

        public function profile_edit($optional=null,$id) {
           if (!$this->User->exists($id)) {
              throw new NotFoundException('Invalid User');
           }
           switch ($this->request->pass[0]) {
               case 'password': 
                    if ($this->request->is('post') || $this->request->is('put')) {
                        $find = $this->User->findDataByPassword($id, $this->request->data);
                        if (!$find) {
                        $this->Flash->error('Current Password Wrong. Please check again !');
                        }
        
                        if ($this->request->data['User']['confirm_password'] !== $this->request->data['User']['password']) {
                        $this->Flash->error('Password Different With Confirm Password. Please Check Again !');
                        }
        
                        if ($find && $this->request->data['User']['confirm_password'] === $this->request->data['User']['password']) {
                        $query = $this->User->editData($id, $this->request->data['User']);
                        if ($query) {
                            $this->Flash->success(__('The user has been saved'));
                            return $this->redirect(array('action' => 'profile'));
                        } else {
                            $this->Flash->error(
                                __('The user could not be saved. Please, try again.')
                            );
                        }
                    }
                }
                break;
            case 'profile' : 
                if ($this->request->is('post') || $this->request->is('put')) {
                    $query = $this->User->editData($id, $this->request->data);
                    if ($query) {
                        $this->Flash->success(__('The user has been saved'));
                        return $this->redirect(array('action' => 'profile'));
                    } else {
                        $this->Flash->error(
                            __('The user could not be saved. Please, try again.')
                        );
                    }
            } else {
                $this->request->data = $this->User->findById($id);
                $this->set("user_profile", $this->request->data);
            }
            break;
           }
        }

        public function edit($id) {
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
                // return $this->redirect(array('action' => 'index')); 
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $query = $this->User->editData($id, $this->request->data);
                if ($query) {
                    $this->Flash->success(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(
                        __('The user could not be saved. Please, try again.')
                    );
                }
            } else {
                $this->request->data = $this->User->findById($id);
            }
        }

        public function delete($username = null, $id = null) {
            $query = $this->User->xoaUser($id);
            if ($id) {
                if ($query) {
                    $this->Session->success(
                        __('The username with name: %s has been deleted.', h($username))
                    );
                } else {
                    $this->Session->error(
                         __('The username with name: %s could not be deleted.', h($username))
                    );
    
                }
            }
    
            if (!$id) {
                if ($query) {
                    $this->Flash->success(
                        __('The username with name: %s has been deleted.', h($username))
                    );
                } else {
                    $this->Flash->error(
                        __('The username with name: %s could not be deleted.', h($username))
                    );
                }
            }
        
            return $this->redirect(array('action' => 'index'));
        }
    }
?>