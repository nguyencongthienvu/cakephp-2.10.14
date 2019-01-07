<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
    class User extends AppModel {
        public $useTable = "users";
        public $validate = array(
            'email' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => 'A username is required',
                    'allowEmpty' => false
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => 'A password is required',
                    'allowEmpty' => false
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('0', '1')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
        );

        public function beforeSave($options = array()) {
            if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
                );
            }
            return true;
        }

        public function getAllData() {
            $option = array(
                'limit' => 2,
                'order' => array(
                    'User.role' => 'desc'
                )
            );
            return $option;
        }


        public function getDataById($id) {
            if ($id) {
                return $this->findById($id);
            }
        }

        public function getDataByFacebookId($id, $token) {
            if ($id && $token) {
                $query = $this->find('first', array(
                    'conditions' => array('facebook_id' => $id)
                ));       
                if ($query) {
                    $sql = "UPDATE users SET access_token = '$token' WHERE facebook_id = $id";
                    $update = $this->query($sql);
                    return $query;
                }
            }
        }

        public function addData($data) {
            if ($data['User']['email'] && $data['User']['password']) {
                $this->create();
                if ($this->save($data)) {
                    return "success";
                } else {
                    return "fail to insert";
                }
            }
            else {
                return "no data";
            }    
        }

        public function editData($id, $data) {
            if ($data && $id) {
                $this->id = $id;
                if ($this->save($data)) {
                    return "Edited success.";
                } else {
                    return "Fail to edit.";
                }
            } else {
                return "Missing Data";
            }
        }

        public function xoaUser($id) {
            if ($id) {
                if($this->delete($id)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
?>