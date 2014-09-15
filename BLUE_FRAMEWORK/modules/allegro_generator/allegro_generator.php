<?php
/**
 * main allegro generator class
 *
 * @category    BlueFramework
 * @package     modules
 * @subpackage  generator
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     0.6.0
 */
class allegro_generator extends module_class
{
    public $requireLibraries    = [];
    public $requireModules      = [];

    const TEMPLATE_DIR = 'modules/allegro_generator/layouts/user_layouts/';

    /**
     * information that use is logged in
     * 
     * @var bool
     */
    protected $_verification;

    /**
     * running module method
     */
    public function run()
    {
        $this->_verification = log_class::verifyUser();
        if ($this->_verification) {
            switch ($this->params[0]) {
                case 'upload':
                    $this->_handleUpload();
                    break;
                case 'form':
                    $this->_handleFormDisplay();
                    break;
            }
        } else {
            if ($this->params[0] === 'upload') {
                $this->generate('empty', json_encode([
                    'status'    => 'false',
                    'message'   => 'Access denied'
                ]), true);
            }
        }
    }

    /**
     * handle all uploading files
     */
    protected function _handleUpload()
    {
//        var_dump($this->files->file);
        $uid        = $this->_getUserId();
        $dir        = starter_class::path(true) . '/images/' . $uid;
        $response   = [
            'status'    => 'false',
            'message'   => ''
        ];

        if ($this->files->uploadErrors) {
            $response['message'] = $this->files->uploadErrors['file'];
            $this->generate('empty', json_encode($response), true);
            return;
        }

        if (!file_exists($dir)) {
            $bool = disc_class::mkdir($dir);
            @chmod($dir, 0777);

            if (!$bool) {
                $response['message'] = 'Cannot create image directory';
                $this->generate('empty', json_encode($response), true);
                return;
            }
        }

//        $fileName = time() . '.' . $this->files->file['extension'];
//        $this->files->move($dir, 'file');
//        $response['status'] = 'success';

        $this->generate('empty', json_encode($response), true);
    }

    /**
     * show user add form
     */
    protected function _handleFormDisplay()
    {
        $this->set('generator', 'js');
        $this->set('base', 'css');
        $this->layout('index');
        $this->_showUserAddForm();
    }

    /**
     * show add form template for current user
     */
    protected function _showUserAddForm()
    {
        $userId      = $this->_getUserId();
        $path        = self::TEMPLATE_DIR . $userId . '/add_form.html';
        $independent = new display_class([
            'independent'   => true,
            'get'           => $this->get,
            'template'      => $path
        ]);

        $this->generate('user_template', $independent->render());
    }

    /**
     * get user id from session
     * 
     * @return null|int
     */
    protected function _getUserId()
    {
        $userData = $this->session->returns('user');

        if (isset($userData['log_class_uid'])) {
            return $userData['log_class_uid'];
        }

        return null;
    }

    public function runErrorMode(){}
}
