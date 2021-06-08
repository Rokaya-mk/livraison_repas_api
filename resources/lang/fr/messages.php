<?php

return [

    //UserController Responses
    //userRegister
    'email_phone_verification'      =>'Un compte est déjà enregistré avec cet e-mail,ou numero de téléphone',
    'mail_subject'                  =>'Vérifiez votre email',
    'verification_blade'            =>'copier ce code pour vérifier votre email',
    'register_success'              =>'le compte a été enregistré avec succès| l\'enregistrement du compte a échoué',
    //login
    'is_verified_email'             =>'vous devez vérifier votre email !',
    'login_msg'                     => 'votre connexion est réussie|vous n\'ètes pas autorisé',
    //emailVerification
    'error_validator'               =>'Erreur de Validation',
    'email_verified'                =>'Votre email a été verifé avec succés!',
    'email_already_verified'        =>'Cet email est déjà vérifié',
    'wrong_token'                   =>'Cet jeton est incorrect',
    'admin_permession'              => 'vous n\'avez pas les permissions',
    //forgotPassword
    'email_exist'                   =>'Cet Email n\'existe pas',
    'reset_pass'                    =>'réinitialiser votre mot de passe',
    'check'                         =>'voir votre boite e-mail',
    //forgot_blade
    'copy_code'                     =>'copiez le code et collez-le dans l\'application',
    //resetPassword
    'invalid_email'                 =>'Cet  Email n\'est pas Valide',
    'invalid_token'                 =>'Cet jeton n\'est pas Valide',
    'reset_sucess'                  =>'Le mot de passe de l’utilisateur a été modifié avec succès',
    //changePassword
    'change_response'               =>'Le mot de passe a été mis à jour avec succès!|Vérifiez votre ancien mot de passe',
    'error_excep'                   =>'Erreur',
    //logoutApi
    'logout_msg'                    =>'vous êtes déconnecté avec succès.|La deconnexion a échoué ',
    //update profile
    'update_profile'                =>'Votre Profile a été mis à jour avec succès!',
    'file_exist'                    =>'Ce Fishier n\'existe pas',
    //allDeliveryGuys
    'exist_delevery'                =>'Vide,vous n\'avez pas ajouter un compte Livreur',
    //---------------------------------Food Controller-----------------------------------------
    //foods
    'foods_msg'                     =>'La liste des repas a été récupérée avec succès!|liste des repas est vide!',
    //add new food
    'add_food'                     =>'Le repas a été ajouter avec succès !',
    //show food
    'found_food'                   =>'Cet repas n\'existe pas!',
    'show_food'                    =>'Le contenu de repas a été récupérée avec succès!',
    //update
    'update_food'                  =>'Le repas a été mis à jour avec succès!|Erreur de mettre à jour cet repas ',
    //update status
    'status_food'                  =>'Les status du repas ont été mis à jour avec succès!|Erreur de mettre à jour les status',
    //delete food
    'delete_food'                  =>'le repas a été supprimer avec succès!|Erreur de supression du repas',
    //search food
    'search_food'                  =>'listes des repas recherchés|Aucun résultat trouvé,essayez avec d’autres mots clés',
    //---------------------------------Category Controller-----------------------------------
    'categories_msg'                =>'La liste des categories a été récupérée avec succès!|liste des repas est vide!',
    'try_error'                     =>'Erreur',
    'add_category'                  =>'La categorie a été ajouter avec succès !',
    //showCategoryProducts
    'found_category'                =>'Cet categories n\'existe pas!',
    'show_msg_cat'                  =>'La liste des produits du categorie a été récupérée avec succès!|Aucun produit dans cette categorie!',
    //update category
    'update_cat'                    =>'La categorie a été mis à jour avec succès!|Erreur de modifier la categorie',
    //delete category
    'delete_cat'                   =>'categorie a été supprimer avec succès!|Erreur de supression du categorie',

   ];

?>
