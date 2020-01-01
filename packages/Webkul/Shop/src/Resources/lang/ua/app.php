<?php

return [
    'security-warning' => 'Suspicious activity found!!!',
    'nothing-to-delete' => 'Nothing to delete',

    'layouts' => [
        'my-account' => 'Мій аккаунт',
        'profile' => 'Персональні дані',
        'address' => 'Адреси на які робилися купівлі',
        'reviews' => 'Reviews',
        'wishlist' => 'Wishlist',
        'orders' => 'Історія замовлень',
        'subscribe-newsletter' => 'Підписка на новини',
        'downloadable-products' => 'Downloadable Products',
        'logout' => 'Вийти'
    ],

    'common' => [
        'error' => 'Something went wrong, please try again later.',
        'no-result-found' => 'We could not find any records.'
    ],

    'home' => [
        'name' => 'Головна',
        'page-title' => config('app.name') . ' - Головна',
        'featured-products' => 'Featured Products',
        'new-products' => 'Новинки та ',
        'new-products' => 'Новинки та ',
        'bestsellers' => 'Бестселери',
        'verify-email' => 'Verify your email account',
        'resend-verify-email' => 'Resend Verification Email'
    ],

    'header' => [
        'help' => 'Допомога?',
        'title' => 'Account',
        'dropdown-text' => 'Manage Cart, Orders & Wishlist',
        'sign-in' => 'Sign In',
        'sign-up' => 'Sign Up',
        'account' => 'Account',
        'cart' => 'Cart',
        'profile' => 'Профіль',
        'wishlist' => 'Wishlist',
        'cart' => 'Cart',
        'logout' => 'Logout',
        'search-text' => 'Пошук'
    ],

    'banner' => [
        'btn-title' => 'хочу подарунок',
        'shopping-btn-title' => 'За покупками',
        'collections-btn-title' => 'Подивитись в магазині',
        'btn-more-details' => 'детальніше',
    ],

    'button' => [
        'read' => 'Читати',
        'buy' => 'Купити',
    ],

    'minicart' => [
        'view-cart' => 'Переглянути кошик',
        'checkout' => 'Оформити замовлення',
        'cart' => 'Cart',
        'zero' => '0'
    ],

    'footer' => [
        'subscribe-newsletter' => 'Subscribe Newsletter',
        'subscribe' => 'Subscribe',
        'locale' => 'Locale',
        'currency' => 'Currency',
    ],

    'subscription' => [
        'unsubscribe' => 'Unsubcribe',
        'subscribe' => 'Підписатися на новини',
        'subscribed' => 'You are now subscribed to subscription emails.',
        'not-subscribed' => 'You can not be subscribed to subscription emails, please try again later.',
        'already' => 'You are already subscribed to our subscription list.',
        'unsubscribed' => 'You are unsubscribed from subscription mails.',
        'already-unsub' => 'You are already unsubscribed.',
        'not-subscribed' => 'Error! Mail can not be sent currently, please try again later.',
        'privacy-policy' => 'Політика конфіденційності',
    ],

    'search' => [
        'no-results' => 'No Results Found',
        'page-title' => config('app.name') . ' - Пошук',
        'found-results' => 'Search Results Found',
        'found-result' => 'Search Result Found'
    ],

    'reviews' => [
        'title' => 'Title',
        'add-review-page-title' => 'Add Review',
        'write-review' => 'Write a review',
        'review-title' => 'Give your review a title',
        'product-review-page-title' => 'Product Review',
        'rating-reviews' => 'Rating & Reviews',
        'submit' => 'SUBMIT',
        'delete-all' => 'All Reviews has deleted Succesfully',
        'ratingreviews' => ':rating Ratings & :review Reviews',
        'star' => 'Star',
        'percentage' => ':percentage %',
        'id-star' => 'star',
        'name' => 'Name'
    ],

    'customer' => [
        'signup-text' => [
            'account_exists' => 'Вже є аккаунт',
            'title' => 'Увійти'
        ],

        'signup-form' => [
            'page-title' => 'Клієнт - Реєстраційна форма',
            'title' => 'Зареєструйтесь',
            'firstname' => 'Ім\'я',
            'lastname' => 'Прізвище',
            'email' => 'Email',
            'password' => 'Пароль',
            'confirm_pass' => 'Підтвердження паролю',
            'button_title' => 'Реєстрація',
            'agree' => 'Agree',
            'terms' => 'Terms',
            'conditions' => 'Conditions',
            'using' => 'by using this website',
            'agreement' => 'Agreement',
            'success' => 'Обліковий запис створено успішно.',
            'success-verify' => 'Account created successfully, an e-mail has been sent for verification.',
            'success-verify-email-unsent' => 'Account created successfully, but verification e-mail unsent.',
            'failed' => 'Error! Can not create your account, pleae try again later.',
            'already-verified' => 'Your account is already verified Or please try sending a new verification email again.',
            'verification-not-sent' => 'Error! Problem in sending verification email, please try again later.',
            'verification-sent' => 'Verification email sent',
            'verified' => 'Your account has been verified, try to login now.',
            'verify-failed' => 'We cannot verify your mail account.',
            'dont-have-account' => 'You do not have account with us.',
            'success' => 'Account Created Successfully',
            'success-verify' => 'Account Created Successfully, an e-mail has been sent for verification.',
            'success-verify-email-unsent' => 'Account created successfully, but verification e-mail unsent',
            'failed' => 'Error! Cannot Create Your Account, Try Again Later',
            'already-verified' => 'Your Account is already verified Or Please Try Sending A New Verification Email Again',
            'verification-not-sent' => 'Error! Problem In Sending Verification Email, Try Again Later',
            'verification-sent' => 'Verification Email Sent',
            'verified' => 'Your Account Has Been Verified, Try To Login Now',
            'verify-failed' => 'We Cannot Verify Your Mail Account',
            'dont-have-account' => 'You Do Not Have Account With Us',
            'customer-registration' => 'Customer Registered Successfully'
        ],

        'login-text' => [
            'no_account' => 'Реєстрація',
            'title' => 'Зареєструватися',
        ],

        'login-form' => [
            'page-title' => 'Customer - Login',
            'title' => 'Увійти',
            'sub-title' => 'Введіть логін і пароль',
            'email' => 'Email',
            'password' => 'Пароль',
            'forgot_pass' => 'Забули пароль?',
            'button_title' => 'Увійти',
            'remember' => 'Remember Me',
            'footer' => '© Copyright :year Webkul Software, All rights reserved',
            'invalid-creds' => 'Please check your credentials and try again.',
            'verify-first' => 'Verify your email account first.',
            'not-activated' => 'Your activation seeks admin approval',
            'resend-verification' => 'Resend verification mail again'
        ],

        'forgot-password' => [
            'title' => 'Recover Password',
            'email' => 'Email',
            'submit' => 'Submit',
            'page_title' => 'Customer - Forgot Password Form'
        ],

        'reset-password' => [
            'title' => 'Reset Password',
            'email' => 'Registered Email',
            'password' => 'Password',
            'confirm-password' => 'Confirm Password',
            'back-link-title' => 'Back to Sign In',
            'submit-btn-title' => 'Reset Password'
        ],

        'account' => [
            'dashboard' => 'Customer - Edit Profile',
            'menu' => 'Menu',

            'profile' => [
                'index' => [
                    'page-title' => 'Клієнт - Профіль',
                    'title' => 'Персональні дані',
                    'edit' => 'Редагувати',
                ],

                'edit-success' => 'Профіль успішно оновлений.',
                'edit-fail' => 'Error! Profile cannot be updated, please try again later.',
                'unmatch' => 'The old password does not match.',

                'fname' => 'Ім\'я',
                'lname' => 'Прізвище',
                'gender' => 'Стать',
                'dob' => 'Дата народження',
                'sub-dob' => 'ми хочем надіслати Вам подарунок',
                'phone' => 'Телефон',
                'email' => 'Email',
                'opassword' => 'Старий пароль',
                'password' => 'Пароль',
                'cpassword' => 'Підтвердження парою',
                'submit' => 'Зберегти',

                'edit-profile' => [
                    'title' => 'Персональні дані - редагування',
                    'page-title' => 'Клієнт - редагуйте форму профілю'
                ]
            ],

            'address' => [
                'index' => [
                    'page-title' => 'Customer - Address',
                    'title' => 'Address',
                    'add' => 'Add Address',
                    'edit' => 'Edit',
                    'empty' => 'You do not have any saved addresses here, please try to create it by clicking the link below',
                    'create' => 'Create Address',
                    'delete' => 'Видалити',
                    'make-default' => 'Make Default',
                    'default' => 'Default',
                    'contact' => 'Contact',
                    'confirm-delete' =>  'Do you really want to delete this address?',
                    'default-delete' => 'Default address cannot be changed.',
                    'enter-password' => 'Введіть ваш пароль.',
                ],

                'create' => [
                    'page-title' => 'Customer - Add Address Form',
                    'title' => 'Add Address',
                    'street-address' => 'Street Address',
                    'country' => 'Country',
                    'state' => 'State',
                    'select-state' => 'Select a region, state or province',
                    'city' => 'City',
                    'postcode' => 'Postal Code',
                    'phone' => 'Phone',
                    'submit' => 'Save Address',
                    'success' => 'Address have been successfully added.',
                    'error' => 'Address cannot be added.'
                ],

                'edit' => [
                    'page-title' => 'Customer - Edit Address',
                    'title' => 'Edit Address',
                    'street-address' => 'Street Address',
                    'submit' => 'Save Address',
                    'success' => 'Address updated successfully.',
                ],
                'delete' => [
                    'success' => 'Address successfully deleted',
                    'failure' => 'Address cannot be deleted',
                    'wrong-password' => 'Wrong Password !'
                ]
            ],

            'order' => [
                'index' => [
                    'page-title' => 'Customer - Orders',
                    'title' => 'Orders',
                    'order_id' => 'Order ID',
                    'date' => 'Date',
                    'status' => 'Status',
                    'total' => 'Total',
                    'order_number' => 'Order Number'
                ],

                'view' => [
                    'page-tile' => 'Order #:order_id',
                    'info' => 'Information',
                    'placed-on' => 'Placed On',
                    'products-ordered' => 'Products Ordered',
                    'invoices' => 'Invoices',
                    'shipments' => 'Shipments',
                    'SKU' => 'SKU',
                    'product-name' => 'Name',
                    'qty' => 'Qty',
                    'item-status' => 'Item Status',
                    'item-ordered' => 'Ordered (:qty_ordered)',
                    'item-invoice' => 'Invoiced (:qty_invoiced)',
                    'item-shipped' => 'shipped (:qty_shipped)',
                    'item-canceled' => 'Canceled (:qty_canceled)',
                    'item-refunded' => 'Refunded (:qty_refunded)',
                    'price' => 'Price',
                    'total' => 'Total',
                    'subtotal' => 'Subtotal',
                    'shipping-handling' => 'Shipping & Handling',
                    'tax' => 'Tax',
                    'discount' => 'Discount',
                    'tax-percent' => 'Tax Percent',
                    'tax-amount' => 'Tax Amount',
                    'discount-amount' => 'Discount Amount',
                    'grand-total' => 'Grand Total',
                    'total-paid' => 'Total Paid',
                    'total-refunded' => 'Total Refunded',
                    'total-due' => 'Total Due',
                    'shipping-address' => 'Shipping Address',
                    'billing-address' => 'Billing Address',
                    'shipping-method' => 'Shipping Method',
                    'payment-method' => 'Payment Method',
                    'individual-invoice' => 'Invoice #:invoice_id',
                    'individual-shipment' => 'Shipment #:shipment_id',
                    'print' => 'Print',
                    'invoice-id' => 'Invoice Id',
                    'order-id' => 'Order Id',
                    'order-date' => 'Order Date',
                    'bill-to' => 'Bill to',
                    'ship-to' => 'Ship to',
                    'contact' => 'Contact',
                    'refunds' => 'Refunds',
                    'individual-refund' => 'Refund #:refund_id',
                    'adjustment-refund' => 'Adjustment Refund',
                    'adjustment-fee' => 'Adjustment Fee',
                ]
            ],

            'downloadable_products' => [
                'title' => 'Downloadable Products',
                'order-id' => 'Order Id',
                'date' => 'Date',
                'name' => 'Title',
                'status' => 'Status',
                'pending' => 'Pending',
                'available' => 'Available',
                'expired' => 'Expired',
                'remaining-downloads' => 'Remaining Downloads',
                'unlimited' => 'Unlimited',
                'download-error' => 'Download link has been expired.'
            ],

            'review' => [
                'index' => [
                    'title' => 'Reviews',
                    'page-title' => 'Customer - Reviews'
                ],

                'view' => [
                    'page-tile' => 'Review #:id',
                ]
            ]
        ]
    ],

    'products' => [
        'layered-nav-title' => 'Фільтр',
        'price-label' => 'As low as',
        'remove-filter-link-title' => 'Очистити',
        'apply-filter-link-title' => 'Підтвердити',
        'sort-by' => 'Sort By',
        'from-a-z' => 'From A-Z',
        'from-z-a' => 'From Z-A',
        'newest-first' => 'Бестселери',
        'oldest-first' => 'Oldest First',
        'cheapest-first' => 'Cheapest First',
        'expensive-first' => 'Expensive First',
        'show' => 'Show',
        'show-more' => 'Показати більше товарів',
        'pager-info' => 'Showing :showing of :total Items',
        'description' => 'Опис',
        'specification' => 'Specification',
        'total-reviews' => ':total Reviews',
        'total-rating' => ':total_rating Ratings & :total_reviews Reviews',
        'by' => 'By :name',
        'up-sell-title' => 'We found other products you might like!',
        'related-product-title' => 'Вам також може ',
        'related-product-bottom' => 'Сподобатися',
        'cross-sell-title' => 'More choices',
        'reviews-title' => 'Ratings & Reviews',
        'write-review-btn' => 'Write Review',
        'choose-option' => 'Choose an option',
        'sale' => 'Sale',
        'new' => 'Нове',
        'empty' => 'No products available in this category',
        'add-to-cart' => 'Додати товар',
        'buy-now' => 'Buy Now',
        'whoops' => 'Whoops!',
        'quantity' => 'Кількість',
        'in-stock' => 'In Stock',
        'out-of-stock' => 'Out Of Stock',
        'view-all' => 'View All',
        'select-above-options' => 'Please select above options first.',
        'less-quantity' => 'Quantity can not be less than one.',
        'samples' => 'Samples',
        'links' => 'Links',
        'sample' => 'Sample',
        'name' => 'Name',
        'qty' => 'Qty',
        'starting-at' => 'Starting at',
        'customize-options' => 'Customize Options',
        'choose-selection' => 'Choose a selection',
        'your-customization' => 'Your Customization',
        'total-amount' => 'Total Amount',
        'none' => 'None',
        'weight-unit' => 'мл',
    ],

    'wishlist' => [
        'title' => 'Wishlist',
        'deleteall' => 'Delete All',
        'moveall' => 'Move All Products To Cart',
        'move-to-cart' => 'Move To Cart',
        'error' => 'Cannot add product to wishlist due to unknown problems, please checkback later',
        'add' => 'Item successfully added to wishlist',
        'remove' => 'Item successfully removed from wishlist',
        'moved' => 'Item successfully moved To cart',
        'option-missing' => 'Product options are missing, so item can not be moved to the wishlist.',
        'move-error' => 'Item cannot be moved to wishlist, Please try again later',
        'success' => 'Item successfully added to wishlist',
        'failure' => 'Item cannot be added to wishlist, Please try again later',
        'already' => 'Item already present in your wishlist',
        'removed' => 'Item successfully removed from wishlist',
        'remove-fail' => 'Item cannot Be removed from wishlist, Please try again later',
        'empty' => 'You do not have any items in your wishlist',
        'remove-all-success' => 'All the items from your wishlist have been removed',
    ],

    // 'reviews' => [
    //     'empty' => 'You Have Not Reviewed Any Of Product Yet'
    // ]

    'buynow' => [
        'no-options' => 'Please select options before buying this product.'
    ],

    'checkout' => [
        'cart' => [
            'integrity' => [
                'missing_fields' => 'Some required fields missing for this product.',
                'missing_options' => 'Options are missing for this product.',
                'missing_links' => 'Downloadable links are missing for this product.',
                'qty_missing' => 'Atleast one product should have more than 1 quantity.'
            ],
            'create-error' => 'Encountered some issue while making cart instance.',
            'title' => 'Кошик',
            'name' => 'Товар',
            'empty' => 'Ваш кошик пустий',
            'update-cart' => 'Оновити кошик',
            'continue-shopping' => 'Продовжити покупки',
            'proceed-to-checkout' => 'Оформити замовлення',
            'remove' => 'Видалити',
            'remove-link' => 'Видалити',
            'move-to-wishlist' => 'Move to Wishlist',
            'move-to-wishlist-success' => 'Item moved to wishlist.',
            'move-to-wishlist-error' => 'Cannot move item to wishlist, please try again later.',
            'add-config-warning' => 'Please select option before adding to cart.',
            'quantity' => [
                'quantity' => 'Кількість',
                'short' => 'к-сть:',
                'success' => 'Зміст кошика успішно оновлено.',
                'illegal' => 'Quantity cannot be lesser than one.',
                'inventory_warning' => 'The requested quantity is not available, please try again later.',
                'error' => 'Cannot update the item(s) at the moment, please try again later.'
            ],

            'item' => [
                'error_remove' => 'Немає продуктів для видалення з кошика.',
                'success' => 'Продукт успішно додано в кошик',
                'success-remove' => 'Продукт успішно видалено з кошика.',
                'error-add' => 'Продукт не можна додати до кошика. Повторіть спробу пізніше.',
            ],
            'quantity-error' => 'Requested quantity is not available.',
            'cart-subtotal' => 'Загальна сума',
            'cart-remove-action' => 'Do you really want to do this ?',
            'partial-cart-update' => 'Only some of the product(s) were updated',
            'link-missing' => ''
        ],
        'gift' => [
            'title' => 'Ваш подарунок',
            'free' => 'Безкоштовний подарунок',
            'free_message' => 'Ви можете вибрати цей безкоштовний подарунок до свого замовлення.',
            'premium' => 'Преміальний подарунок',
            'premium-message' => 'Купіть ще на %s і отримаєте цей безкоштовний подарунок',
            'gift-change' => 'У Вас змінився подарунок від суми замовлення.',
            'gift-selected' => 'Вами був вибраний інший подарунок.',
            'gift-available' => 'Вітаємо, тепер у Вас є подарунок.',
            'gift-not-available' => 'Дуже шкода, але суми замовлення не хватає для отримання подарунка.',
        ],

        'onepage' => [
            'title' => 'Оформлення замовлення',
            'cart-title' => 'Ваше замовлення',
            'information' => 'Дані',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'complete' => 'Complete',
            'billing-address' => 'Платіжна адреса',
            'sign-in' => 'Увійти',
            'first-name' => 'Ім\'я',
            'last-name' => 'Прізвище',
            'email' => 'Email',
            'address1' => 'Вулиця',
            'city' => 'Місто',
            'state' => 'Область',
            'select-state' => 'Select a region, state or province',
            'postcode' => 'Поштовий індекс',
            'phone' => 'Телефон',
            'country' => 'Країна',
            'order-summary' => 'Загальна сума',
            'shipping-address' => 'Shipping Address',
            'use_for_shipping' => 'Доставка на цю адресу',
            'continue' => 'Continue',
            'shipping-method' => 'Select Shipping Method',
            'payment-methods' => 'Select Payment Method',
            'payment-method' => 'Payment Method',
            'summary' => 'Загальна сумма',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'contact' => 'Contact',
            'place-order' => 'Розмістити замовлення',
            'new-address' => 'Add New Address',
            'save_as_address' => 'Save as Address',
            'apply-coupon' => 'Apply Coupon',
            'amt-payable' => 'Amount Payable',
            'got' => 'Got',
            'free' => 'Free',
            'coupon-used' => 'Coupon Used',
            'applied' => 'Applied',
            'back' => 'Back',
            'cash-desc' => 'Cash On Delivery',
            'money-desc' => 'Money Transfer',
            'paypal-desc' => 'Paypal Standard',
            'free-desc' => 'This is a free shipping',
            'flat-desc' => 'This is a flat rate',
            'password' => 'Password',
            'login-exist-message' => 'You already have an account with us, Sign in or continue as guest.'
        ],

        'total' => [
            'order-summary' => 'Order Summary',
            'sub-total' => 'Загальна сума',
            'grand-total' => 'Сума з доставкою',
            'delivery-charges' => 'Вартість доставки',
            'tax' => 'Податок',
            'discount' => 'Discount',
            'price' => 'ціна',
            'disc-amount' => 'Сума зі знижкою',
            'new-grand-total' => 'New Grand Total',
            'coupon' => 'Coupon',
            'coupon-applied' => 'Coupon Applied',
            'remove-coupon' => 'Remove Coupon',
            'cannot-apply-coupon' => 'Cannot Apply Coupon'
        ],

        'success' => [
            'title' => 'Order successfully placed',
            'thanks' => 'Thank you for your order!',
            'order-id-info' => 'Your order id is #:order_id',
            'info' => 'We will email you, your order details and tracking information'
        ]
    ],

    'mail' => [
        'order' => [
            'subject' => 'New Order Confirmation',
            'heading' => 'Order Confirmation!',
            'dear' => 'Dear :customer_name',
            'dear-admin' => 'Dear :admin_name',
            'greeting' => 'Thanks for your Order :order_id placed on :created_at',
            'greeting-admin' => 'Order Id :order_id placed on :created_at',
            'summary' => 'Summary of Order',
            'shipping-address' => 'Shipping Address',
            'billing-address' => 'Billing Address',
            'contact' => 'Contact',
            'shipping' => 'Shipping Method',
            'payment' => 'Payment Method',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'subtotal' => 'Subtotal',
            'shipping-handling' => 'Shipping & Handling',
            'tax' => 'Tax',
            'discount' => 'Discount',
            'grand-total' => 'Grand Total',
            'final-summary' => 'Thanks for showing your interest in our store we will send you tracking number once it shipped',
            'help' => 'If you need any kind of help please contact us at :support_email',
            'thanks' => 'Thanks!',
            'cancel' => [
                'subject' => 'Order Cancel Confirmation',
                'heading' => 'Order Cancelled',
                'dear' => 'Dear :customer_name',
                'greeting' => 'You Order with order id #:order_id placed on :created_at has been cancelled',
                'summary' => 'Summary of Order',
                'shipping-address' => 'Shipping Address',
                'billing-address' => 'Billing Address',
                'contact' => 'Contact',
                'shipping' => 'Shipping Method',
                'payment' => 'Payment Method',
                'subtotal' => 'Subtotal',
                'shipping-handling' => 'Shipping & Handling',
                'tax' => 'Tax',
                'discount' => 'Discount',
                'grand-total' => 'Grand Total',
                'final-summary' => 'Thanks for showing your interest in our store',
                'help' => 'If you need any kind of help please contact us at :support_email',
                'thanks' => 'Thanks!',
            ]
        ],

        'invoice' => [
            'heading' => 'Your invoice #:invoice_id for Order #:order_id',
            'subject' => 'Invoice for your order #:order_id',
            'summary' => 'Summary of Invoice',
        ],

        'shipment' => [
            'heading' => 'Shipment #:shipment_id  has been generated for Order #:order_id',
            'inventory-heading' => 'New shipment #:shipment_id had been generated for Order #:order_id',
            'subject' => 'Shipment for your order #:order_id',
            'inventory-subject' => 'New shipment had been generated for Order #:order_id',
            'summary' => 'Summary of Shipment',
            'carrier' => 'Carrier',
            'tracking-number' => 'Tracking Number',
            'greeting' => 'An order :order_id has been placed on :created_at',
        ],

        'refund' => [
            'heading' => 'Your Refund #:refund_id for Order #:order_id',
            'subject' => 'Refund for your order #:order_id',
            'summary' => 'Summary of Refund',
            'adjustment-refund' => 'Adjustment Refund',
            'adjustment-fee' => 'Adjustment Fee'
        ],

        'forget-password' => [
            'subject' => 'Customer Reset Password',
            'dear' => 'Dear :name',
            'info' => 'You are receiving this email because we received a password reset request for your account',
            'reset-password' => 'Reset Password',
            'final-summary' => 'If you did not request a password reset, no further action is required',
            'thanks' => 'Thanks!'
        ],

        'customer' => [
            'new' => [
                'dear' => 'Dear :customer_name',
                'username-email' => 'UserName/Email',
                'subject' => 'New Customer Registration',
                'password' => 'Password',
                'summary' => 'Your account has been created.
                Your account details are below: ',
                'thanks' => 'Thanks!',
            ],

            'registration' => [
                'subject' => 'New Customer Registration',
                'customer-registration' => 'Customer Registered Successfully',
                'dear' => 'Dear :customer_name',
                'greeting' => 'Welcome and thank you for registering with us!',
                'summary' => 'Your account has now been created successfully and you can login using your email address and password credentials. Upon logging in, you will be able to access other services including reviewing past orders, wishlists and editing your account information.',
                'thanks' => 'Thanks!',
            ],

            'verification' => [
                'heading' => config('app.name') . ' - Email Verification',
                'subject' => 'Verification Mail',
                'verify' => 'Verify Your Account',
                'summary' => 'This is the mail to verify that the email address you entered is yours.
                Kindly click the Verify Your Account button below to verify your account.'
            ],

            'subscription' => [
                'subject' => 'Subscription Email',
                'greeting' => ' Welcome to ' . config('app.name') . ' - Email Subscription',
                'unsubscribe' => 'Unsubscribe',
                'summary' => 'Thanks for putting me into your inbox. It’s been a while since you’ve read ' . config('app.name') . ' email, and we don’t want to overwhelm your inbox. If you still do not want to receive
                the latest email marketing news then for sure click the button below.'
            ]
        ]
    ],

    'webkul' => [
        'copy-right' => '© Copyright :year Webkul Software, All rights reserved',
    ],

    'response' => [
        'create-success' => ':name created successfully.',
        'update-success' => ':name updated successfully.',
        'delete-success' => ':name deleted successfully.',
        'submit-success' => ':name submitted successfully.'
    ],
];
