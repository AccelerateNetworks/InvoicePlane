<html lang="<?php echo lang('cldr'); ?>">
<head>
  <meta charset="utf-8">
  <title><?php echo lang('invoice'); ?></title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AccelerateNetworks/css/pdf.css">
</head>
<body>
<div class="container">
  <table>
    <tr>
      <td class="to">
        <h1>Customer:</h1>
        <blockquote>
          <b><?php echo $invoice->client_name; ?></b><br />
          <?php
          if($invoice->client_address_1) {echo $invoice->client_address_1."<br />";}
          if($invoice->client_address_2) {echo $invoice->client_address_2."<br />";}
          if($invoice->client_city && $invoice->client_state && $invoice->client_zip) {
            echo $invoice->client_city.", ".$invoice->client_state." ".$invoice->client_zip;
          }
          ?><br />
        </blockquote>
      </td>
      <td class="right-align">
        <table>
          <tr><td>Invoice #</td><td><?php echo $invoice->invoice_number; ?></td></tr>
          <tr><td>Billed</td><td><?php echo date_from_mysql($invoice->invoice_date_created, true); ?></td></tr>
          <tr><td>Due</td><td><?php echo date_from_mysql($invoice->invoice_date_due, true); ?></td></tr>
        </table>
      </td>
    </tr>
  </table>
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
    <?php echo $invoice->user_city.", ".$invoice->user_state." ".$invoice->user_zip; ?><br />
  </blockquote>

<footer>
    <?php if ($invoice->invoice_terms) : ?>
        <div class="notes">
            <b><?php echo lang('terms'); ?></b><br/>
            <?php echo nl2br($invoice->invoice_terms); ?>
        </div>
    <?php endif; ?>
</footer>
</div>
</body>
</html>
