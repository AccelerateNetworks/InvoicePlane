<html lang="<?php echo lang('cldr'); ?>">
<head>
  <meta charset="utf-8">
  <style type="text/css">
  .table th {
    border-bottom: solid black 1px;
    border-left: solid black 1px;
  }
  .table td {
    border-left: solid black 1px;
    padding: 2px;
  }
  .table {
    border-top: solid black 1px;
    border-right: solid black 1px;
    border-bottom: solid black 1px;
  }
  .topbar td {
    border-top: solid black 1px;
  }
  .right-align {
    text-align: right;
  }
  h1 {
    margin: 0px;
  }
  .topright {
    position: absolute;
    top: 2em;
    right: 2em;
  }
  </style>
</head>
<body>
<div class="container">
  <div class="topright">
    <table>
      <tr><td>Invoice #</td><td><?php echo $invoice->invoice_number; ?></td></tr>
      <tr><td>Billed</td><td><?php echo date_from_mysql($invoice->invoice_date_created, true); ?></td></tr>
      <tr><td>Due</td><td><?php echo date_from_mysql($invoice->invoice_date_due, true); ?></td></tr>
    </table>
  </div>
  <h1>Customer:</h1>
  <blockquote>
    <b><?php echo $invoice->client_name; ?></b><br />
    <?php
    if($invoice->client_address_1) {echo $invoice->client_address_1."<br />";}
    if($invoice->client_address_2) {echo $invoice->client_address_2."<br />";}
    if($invoice->client_address_1) {echo $invoice->client_address_1;}
    if($invoice->client_city && $invoice->client_state && $invoice->client_zip) {
      echo $invoice->client_city.", ".$invoice->$client_state." ".$invoice->$client_zip;
    }
    ?><br />
  </blockquote>
  <br />
  <table class="table" width="100%" border="0" cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item) {  ?>
      <tr>
        <td><?php echo $item->item_name; ?></td>
        <td class="right-align"><?php echo format_amount($item->item_quantity); ?></td>
        <td class="right-align"><?php echo format_currency($item->item_price); ?></td>
        <td class="right-align"><?php echo format_currency($item->item_subtotal); ?></td>
      </tr>
      <?php } ?>
      <tr class="topbar">
        <td><b>Grand total</b></td>
        <td></td>
        <td></td>
        <td class="right-align"><?php echo format_currency($invoice->invoice_total); ?></td>
      </tr>
    </tbody>
  </table><br />
  <h1>Pay to the order of:</h1>
  <blockquote>
    <b><?php echo $invoice->user_name; ?></b><br />
    <b><?php echo $invoice->user_organization; ?></b><br />
    <?php echo $invoice->user_address_1; ?><br />
    <?php echo $invoice->user_city.", ".$invoice->$user_state." ".$invoice->$user_zip; ?><br />
  </blockquote>
</div>
</body>
</html>
