<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper
{

    public function getActiveOpenClass($controller)
    {
        if (is_array($controller)) {
            foreach ($controller as $k => $con) {
                if (isset($this->request->params['controller']) && $this->request->params['controller'] == $con) {
                    return 'active';
                }
            }
        }
        if (isset($this->request->params['controller']) && $this->request->params['controller'] == $controller) {
            return 'active open';
        }
    }

    public function getActiveClass($controller, $action = 'index')
    {
        if (isset($this->request->params['controller']) && $this->request->params['controller'] == $controller) {
            if (is_array($action)) {
                foreach ($action as $key => $value) {
                    if ($this->action == $value) {
                        return 'active';
                    }
                }
            }
        }
    }

    public function getPrice($price, $currency = CURRENCY)
    {
        return $currency . $price;
    }

    public function getSpace($space, $measurement = PLAN_SPACE)
    {
        return $space . ' ' . $measurement;
    }
}
