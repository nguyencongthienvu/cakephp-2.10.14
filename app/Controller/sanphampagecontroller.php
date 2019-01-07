<?php 
class sanphampagecontroller extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('posts', $this->sanphampage->getData());
    }

    public function detail($id) {
        if ($id) {
            $dataDetail = $this->sanphampage->getDataById($id);
            if ($dataDetail) {
                $this -> set('detail', $dataDetail);
            }
        }
    }

    public function themsanpham() {
       if ($this->request->is('post')) {
           if ($this->request->data['sanphampage']['title']) {
            $query = $this->sanphampage->addSanPham($this->request->data);
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

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        } else {
            $data = $this->sanphampage->getDataById($id);
            if (!$data) {
                throw new NotFoundException(__('Invalid post'));
            } else {
                if (!$this->request->data) {
                    $this->request->data = $data;
                }
            }
        }
    
        if ($this->request->is('put')) {
            if ($this->request->data['sanphampage']['title'] && $id) {
                $query = $this->sanphampage->editSanPham($this->request->data, $id);
                    if ($query === "Edited success.") {
                        $this->Session->setFlash($query);
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash($query);
                    }
                } else {
                $this->Session->setFlash("Missing field");
            }
        }
    }

    public function delete($title = null, $id = null) {
        $query = $this->sanphampage->xoaSanPham($id);
        if ($id) {
            if ($query) {
                $this->Flash->success(
                    __('The post with name: %s has been deleted.', h($title))
                );
            } else {
                $this->Flash->error(
                     __('The post with name: %s could not be deleted.', h($title))
                );

            }
        }

        if (!$id) {
            if ($query) {
                $this->Flash->success(
                    __('The post with name: %s has been deleted.', h($title))
                );
            } else {
                $this->Flash->error(
                    __('The post with name: %s could not be deleted.', h($title))
                );
            }
        }
    
        return $this->redirect(array('action' => 'index'));
    }
}
?>