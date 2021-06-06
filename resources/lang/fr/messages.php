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
    'exist_delevery'                 =>'Vide,vous n\'avez pas ajouter un compte Livreur',


   ];

?>
