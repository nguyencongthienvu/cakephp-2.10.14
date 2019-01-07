<?php 
    class sanphampage extends AppModel {
        public $useTable = "postviews";
        public function getData() {
            return $this->find('all');
        }

        public function getDataById($id) {
            return $this -> findById($id);
        }

        public function addSanPham($data) {
            if ($data) {
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

        public function editSanPham($data, $id) {
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

        public function xoaSanPham($id) {
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