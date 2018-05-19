function VerrificationAjoutProduit()
{
    var Nom = document.forms["ajouterProduit"]["txtNomProduit"].value;
    if (Nom == null  )
    {
        window.alert("Erreur dans la saise du nom")
    }
}