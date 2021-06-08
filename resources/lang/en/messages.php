<?php

return [

    //UserController Responses
    //userRegister
    'email_phone_verification'    =>'your email or phone number already used',
    'mail_subject'                =>'Verify your email',
    'verification_blade'          =>'copy this code to check your email',
    'register_success'            =>'Successfully Registered|Registration Failed',
    //login
    'is_verified_email'           =>'Verify your email',
    'login_msg'                   => 'you logging in successfully|Unauthorised',
    //emailVerification
    'error_validator'             =>'Validate Error',
    'email_verified'              =>'Email verified',
    'email_already_verified'      =>'Email is already Verified',
    'wrong_token'                 =>'Wrong token',
    'admin_permession'            => 'you don\'t have rights',
    //forgotPassword
    'email_exist'                 =>'This Email does not exist',
    'reset_pass'                  =>'Reset your password',
    'check'                       =>'check your email',
    //forgot_blade
    'copy_code'                   =>'copy the code and paste it in the app',
    //resetPassword
    'invalid_email'               =>'Invalid Email',
    'invalid_token'               =>'Invalid token',
    'reset_sucess'                =>'User password changed successfully',
    //changePassword
    'change_response'             =>'password updated Seccessfully!|Verify your old password',
    'error_excep'                 =>'Error',
    //logoutApi
    'logout_msg'                  =>'Successfully logged out|Unable to logout user',
    //update profile
    'update_profile'              =>'Information Updated Successfully',
    'file_exist'                  =>'File does not exists',
    //allDeliveryGuys
    'exist_delevery'               =>'Empty,You did not add a Delivery guy Yet!',
//---------------------------------Food Controller-----------------------------------------
    //foods
    'foods_msg'                    =>'Foods list retrieved Successfully!|foods list is empty!',
    //add new food
    'add_food'                     =>'Food added Successfully!',
    //show food
    'found_food'                   =>'food not founded!',
    'show_food'                    =>'food retrieved Successfully!',
    //update
    'update_food'                  =>'food updated Successfully!|Error to update this food',
    //update status
    'status_food'                  =>'food status updated Successfully!|Error to update food status',
    //delete food
    'delete_food'                  =>'food deleted successfully|Error to delete food',
    //search food
    'search_food'                  =>'foods founded|can\'t find this food name ,try by other keywords',
//---------------------------------Category Controller-----------------------------------
    'categories_msg'               =>'Categories list retrieved Successfully!|categories list is empty!',
    'try_error'                    =>'Error',
    'add_category'                 =>'category added Successfully!',
    //showCategoryProducts
    'found_category'               =>'category not founded!',
    'show_msg_cat'                 =>'products category retrieved Successfully!|there is no product in this category',
    //update category
    'update_cat'                   =>'category updated Successfully!|Error to update this category',
    //delete category
    'delete_cat'                   =>'category deleted successfully|Error to delete category',





   ];

?>
