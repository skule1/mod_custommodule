<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class CustomModuleModelExample extends BaseDatabaseModel
{
    public function getItems($brukerid)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        //SELECT c.title,a.order_id,a.product_id,a.product_name,a.product_sku,a.quantity,a.price,a.total_price,c.value,b.total,b.order_number,b.id,b.invoice_number,b.customer_id,b.firstname,b.firstname,b.payment_method,b.payment_method_title,b.`comment`,b.delivery_date,b.created_date,b.modified_date,b.modified_by,b.checked_out_time   
        // $query->select('*')
        //     ->from($db->quoteName('#__eshop_orderproducts', 'a'))
        //     ->innerJoin($db->quoteName('#__eshop_orders', 'b') . ' ON ' . $db->quoteName('a.order_id') . ' = ' . $db->quoteName('b.id'))
        //     ->innerJoin($db->quoteName('#__eshop_ordertotals', 'c') . ' ON ' . $db->quoteName('a.order_id') . ' = ' . $db->quoteName('c.order_id'))
        //     ->where($db->quoteName('b.customer_id') . ' = ".$brukerid."')
        //     ->where($db->quoteName('c.name') . ' = ' . $db->quote('shipping'))
        //     ->order('b.created_date');


        // $query = 'SELECT * FROM `#__eshop_orderproducts` AS `a` INNER JOIN `#__eshop_orders` AS `b` ON `a`.`order_id` = `b`.`id` '
        //     . 'INNER JOIN `#__eshop_ordertotals` AS `c` ON `a`.`order_id` = `c`.`order_id` '
        //     . 'WHERE `b`.`customer_id` = ' . $brukerid . ' AND `c`.`name` = "shipping" ORDER BY b.created_date';


        $query = 'SELECT *,ROW_NUMBER() OVER (PARTITION BY a.order_id ORDER BY a.product_id) AS nr '
            . ' FROM #__eshop_orderproducts a INNER  JOIN #__eshop_orders b ON a.order_id=b.id '
            . 'inner join #__eshop_ordertotals c on a.order_id=c.order_id '
            . ' WHERE b.customer_id=' . $brukerid . ' AND  c.name="shipping" ;';





        $db->setQuery($query);
        // echo '$query: ' . $query . '<br>';
        return $db->loadObjectList();
    }

    public function bruker()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        //SELECT c.title,a.order_id,a.product_id,a.product_name,a.product_sku,a.quantity,a.price,a.total_price,c.value,b.total,b.order_number,b.id,b.invoice_number,b.customer_id,b.firstname,b.firstname,b.payment_method,b.payment_method_title,b.`comment`,b.delivery_date,b.created_date,b.modified_date,b.modified_by,b.checked_out_time   
        // $query = 'SELECT username, userid, client_id, time FROM `#__session` WHERE guest = 0;';

        $query = 'SELECT * FROM `orct6_session`  WHERE client_id = 0 AND username>""';

        $db->setQuery($query);
        return $db->loadObject();
    }
}