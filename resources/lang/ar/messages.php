<?php

return [
    //UserController Responses
    //userRegister
    'email_phone_verification'          => 'يوجد حساب مسجل بنفس البريد الإلكتروني, رقم الهاتف',
    'mail_subject'                      =>'قم يتأكيد بريدك الإلكتروني ',
    'verification_blade'                =>'قم بنسخ هذا الرمز للتأكيد بريدك الإلكتروني',
    'register_success'                  =>'فشل في التسجيل |تم تسجيل الحساب بنجاح',
    //login
    'is_verified_email'                 =>'يجب أن تتحقق من بريدك الإلكتروني!',
    'login_msg'                         => 'غير مصرح لك ,تاكد من معلوماتك|تم التسجيل بنجاح',
    //emailVerification
    'error_validator'                   =>'خطأ في تأكيد المعطيات',
    'email_verified'                    =>'تم التحقق من البريد الإلكتروني',
    'email_already_verified'            =>' هذا البريدالإلكتروني تم تأكيده مسبقا ',
    'wrong_token'                       =>'هذا الرمز خاطئ',
    'admin_permession'                  =>'ليس لديك الصلاحيات',
    //forgotPassword
    'email_exist'                       =>'لا يوجد حساب بهذا البريدالإلكتروني ',
    'reset_pass'                        =>'أعد تعيين كلمة السر الخاصة بحسابك',
    'check'                             =>'تفقد بريدك الالكتروني',
    //forgot_blade
    'copy_code'                         =>'قم بنسخ هذا الرمز ,ثم اكتبه في التطبيق',
    //resetPassword
    'invalid_email'                     =>'هذا البريد الإلكتروني غير صالح',
    'invalid_token'                     =>'هذا الرمز غير صالح',
    'reset_sucess'                      =>' تم تغيير كلمة مرور المستخدم بنجاح',
    //changePassword
    'change_response'                   =>'تأكد من كلمة السر القديمة|تم تحديث كلمة السر بنجاح!',
    'error_excep'                       =>'خطأ',
    //logoutApi
    'logout_msg'                        =>'فشل فصل الاتصال|تم تسجيل الخروج بنجاح ',
    //update profile
    'update_profile'                    =>' !تم تحديث معلومات حسابك بنجاح ',
    'file_exist'                        =>'الملف غير موجود',
    //allDeliveryGuys
    'exist_delevery'                    =>'فارغة,لم يتم اضافة حساب لعامل التوصيل',


   ];

?>
