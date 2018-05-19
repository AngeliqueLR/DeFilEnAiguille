<?php echo form_open('Client/ValiderPanier'); ?>
<table cellpadding = 6 cellspacing = 1 style="width:100%" border = 1>
    <tr>
        <th>Nom</th>
        <!--<th>Prix</th>!-->
        <th>Quantité</th>
        <th>Total</th>
        <th>Supprimer</th>
        <th>Valider</th>
    </tr>

    <?php
        $i = 1;
        foreach ($this->cart->contents() as $Produit):
            echo form_hidden($i.'[rowid]', $Produit['rowid']);
    ?>

        <tr>
            <td><?php echo $Produit['name'];?></td>
            <!--<td style="text-align:right"><//?php echo $this->cart->format_number($Produit['price']); ?>€</td>!-->
            <td><a href = "<?php echo site_url('Visiteur/modifierQteMoins/'.$Produit['rowid'].'/'.$Produit['qty']);?>"><span class = "glyphicon glyphicon-minus-sign"></span></a><?php echo form_input(array('readonly' => 'readonly', 'name' => $i.'[qty]', 'value' => $Produit['qty'], 'maxlength' => '3', 'size' => '5')); ?><a href = "<?php echo site_url('Visiteur/modifierQtePlus/'.$Produit['rowid'].'/'.$Produit['qty'].'/'.$Produit['option']);?>"><span class = "glyphicon glyphicon-plus-sign"></a></span></td>
            <td style="text-align:right"><?php echo $this->cart->format_number($Produit['subtotal']); ?>€</td>
            <td><a href = "<?php echo site_url('Visiteur/modifierQteMoins/'.$Produit['rowid'].'/1');?>"><span class = "glyphicon glyphicon-remove"></span> Supprimer cet article</a></td>
            <td><a href = "<?php echo site_url('Client/ValiderPanier/'.$Produit['id'].'/'.$Produit['qty'].'/'.$Produit['option'].'/'.$Produit['rowid']);?>"><span class = "glyphicon glyphicon-ok"></span> Valider cet article</a></td>
        </tr>

    <?php 
        $i = $i + 1;
        endforeach;
    ?>

    <tr>
        <td colspan="3"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?>€</td>
    </tr>

</table><br/>
<p><?php echo form_submit('', 'Valider l\'ensemble du panier'); ?></p>
