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
    //---------------------------------Food Controller-----------------------------------------
    //foods
    'foods_msg'                         =>'القائمة فارغة|تم استرجاع قائمة الأغذية بنجاح',
    //add new food
    'add_food'                          =>'!تم اضافة الوجبة بنجاح',
    //show food
    'found_food'                        =>'هذه الوجبة غير موجودة',
    'show_food'                         =>'تم استرجاع محتوى الوجبة بنجاح!',
    //update
    'update_food'                       =>' خطأ لا يمكن التعديل على التصنيف |تم التعديل على الوجبة بنجاح',
    //update status
    'status_food'                       =>' خطأ لا يمكن التعديل على حالة التصنيف |تم التعديل على حالة الوجبة بنجاح',
    //delete food
    'delete_food'                       =>'خطأ في حذف الوجبة |تم خذف الوجبة بنجاح',
    //search food
    'search_food'                       =>'  لم يتم العثور على اي نتائج  |قائمة بالوجبات المطلوبة  ',
    //---------------------------------Category Controller-----------------------------------
    'categories_msg'                    =>'!القائمة فارغة|تم استرجاع قائمة التصنيفات بنجاح!',
    'try_error'                         =>'خطأ',
    'add_category'                      =>'!تم اضافة التصنيف بنجاح',
    //showCategoryProducts
    'found_category'                    =>'!هذاالتصنيف غير موجود',
    'show_msg_cat'                      =>'لا نوجد اية وجبة في هذا التصنيف|تم استرجاع قائمةالوجبات في هذاالتصنيف بنجاح',
    //update category
    'update_cat'                        =>'خطأ,لا يمكن التعديل على التصنيف |تم التعديل على التصنيف بنجاح',
    //delete category
    'delete_cat'                        =>'خطأ في حذف التصنيف |تم خذف التصنيف بنجاح',
    //--------------------------------------PromotionController-----------------------------------------------------
    //displaypromotions
    'promotions_msg'                   =>'!القائمة فارغة|تم استرجاع قائمة التخفيضات بنجاح!',
    'promo_date_create'                =>'تاريخ تفعيل التخفيض يجب ان يكون اكبر من تاريخ اليوم',
    'promo_date_exp'                   =>'تاريخ انتهاء صلاحية التخفيض يجب ان تكون أكبر من تاريخ بدأ التخفيض',
    'promo_add'                        =>'!تم اضافة التخفيض بنجاح بنجاح',
    'promo_show'                       =>'هذا التخفيض غير موجودة|تم استرجاع التخفيض بنجاح',
    'promo_products'                   =>'لا نوجد اية وجبة في هذا التخفيض|تم استرجاع قائمةالوجبات في هذا التخفيض بنجاح',
    'promo_update'                     =>'تم التعديل على التحفيض بنجاح',
    'promo_disable'                    =>'تم الغاء تفعيل التخفيض  بنجاح!',
    'promo_delete'                     =>'خطأ في حذف التخفيض |تم خذف التخفيض بنجاح',


   ];

?>
