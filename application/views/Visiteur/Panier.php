<div class = "well" id="well">
    <?php echo form_open('Client/ValiderPanier'); ?>
    <table class="table table-hover" id="panier" cellpadding = 6  style="width:100%">
        <thead class="titrepanier">
            <tr>
                <th>Nom</th>
                <!--<th>Prix</th>!-->
                <th>Quantité</th>
                <th>Total</th>
                <th>Supprimer</th>
                <th>Valider</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $i = 1;
                foreach ($this->cart->contents() as $Produit):
                    echo form_hidden($i.'[rowid]', $Produit['rowid']);
            ?>

                <tr>
                    <td><?php echo '<h5 class="nompanier">'.$Produit['name'].'</h5>';?></td>
                    <!--<td style="text-align:right"><//?php echo $this->cart->format_number($Produit['price']); ?>€</td>!-->
                    <td><a class="lienPanier" href = "<?php echo site_url('Visiteur/modifierQteMoins/'.$Produit['rowid'].'/'.$Produit['qty']);?>"><span class = "glyphicon glyphicon-minus-sign"></span> </a><?php echo form_input(array('readonly' => 'readonly', 'id' => 'quantitePanier', 'name' => $i.'[qty]', 'value' => $Produit['qty'], 'maxlength' => '3', 'size' => '5')); ?><a class="lienPanier" href = "<?php echo site_url('Visiteur/modifierQtePlus/'.$Produit['rowid'].'/'.$Produit['qty'].'/'.$Produit['option']);?>"><span class = "glyphicon glyphicon-plus-sign"></a></span></td>
                    <td><?php echo '<h5 class="nompanier">'.$this->cart->format_number($Produit['subtotal']); ?>€</h5></td>
                    <td><h5><a class="lienPanier" href = "<?php echo site_url('Visiteur/modifierQteMoins/'.$Produit['rowid'].'/1');?>"><span class = "glyphicon glyphicon-remove"></span> Supprimer cet article</a></h5></td>
                    <td><h5><a class="lienPanier" href = "<?php echo site_url('Client/ValiderPanier/'.$Produit['id'].'/'.$Produit['qty'].'/'.$Produit['option'].'/'.$Produit['rowid']);?>"><span class = "glyphicon glyphicon-ok"></span> Valider cet article</a></h5></td>
                </tr>

            <?php 
                $i = $i + 1;
                endforeach;
            ?>

            <tr>
                <td colspan="3"> </td>
                <td class="right"><h5 id="totalpanier"><strong>Total</strong></h5></td>
                <td class="right"><?php echo '<h5 id="prixpanier">'.$this->cart->format_number($this->cart->total()); ?>€</h5></td>
            </tr>
        </tbody>

    </table><br/>
    <p><button class="btn btn-md btn-default" id="bouton">Valider l'ensemble du panier</button></p>
</div>