<?php
// No direct access
defined('_JEXEC') or die;

$model = new CustomModuleModelExample();
$bruker = $model->bruker()->userid; //, userid, client_id
//echo 'bruker ' . $bruker . '<br>';
echo '<table><tr><th style="text-align: center;">Bestilt</th>'
    //.'<th style="text-align: center;">Levert'
    . '</th><th style="text-align: right;"'
    . '>Ordre</th><th style="text-align: right;">ID</th><th style="text-align: left; padding-left: 10px;">Produkt</th><th style="text-align: left;">Ant</th><th style="text-align: right;">'
    . 'Pris</th style="text-align: right;"><th style="text-align: right;">Sum</th><th style="text-align: right;">Frakt</th><th style="text-align: right;">Total</th>'
    . '<th style="text-align: left; padding-left: 10px;">Betalingsmåte</th></tr>';
if (!empty($data)) {
    foreach ($data as $item) {
        echo
        '</tr><td style="width:100px; text-align:right;">'  . date("d.m.Y", strtotime($item->created_date))
            //   . '</td><td style="width:100px; text-align:right;">' . date("d.m.Y", strtotime($item->delivery_date)) // $item->delivery_date //->format('d-m-Y')
            . '</td><td style="width:50px; text-align:right;" >' . $item->order_id    // formatcurrency($item->price, "NOK") 
            . '</td><td style="width:50px; text-align:right;">' . $item->product_id
            . '</td><td style="width:300px; text-align:left; padding-left: 10px;">' . $item->product_name
            . '</td><td style="width:30px; text-align:right;"> ' . $item->quantity
            . '</td><td style="width:100px; text-align:right;"> ' .  number_format($item->price, 2, ',', '.')
            . '</td><td style="width:100px; text-align:right;">' .   number_format($item->total_price, 2, ',', '.');
        if ($item->nr == 1)
            echo '</td><td style="width:80px; text-align:right;"> ' . number_format($item->value, 2, ',', '.')
                . '</td><td style="width:100px; text-align:right;"> ' . number_format($item->total, 2, ',', '.');
        else
            echo '</td><td></td><td>';
        echo '</td><td style="width:60px; text-align:left; padding-left: 10px;">' .  substr($item->payment_method_title, 0, 15);

        '</td></tr>';
    }
} else {
    echo '<p>No data available.</p>';
}
echo '</table>';