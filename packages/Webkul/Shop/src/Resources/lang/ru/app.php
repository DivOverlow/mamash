<?php

return [
    'security-warning' => 'Suspicious activity found!!!',
    'nothing-to-delete' => 'Nothing to delete',

    'layouts' => [
        'my-account' => 'Мой аккаунт',
        'profile' => 'Персональные данные',
        'address' => 'Адреса на которые делались покупки',
        'reviews' => 'Reviews',
        'wishlist' => 'Wishlist',
        'orders' => 'История заказов',
        'subscribe-newsletter' => 'Подписка на новости',
        'downloadable-products' => 'Downloadable Products',
        'logout' => 'Выйти'
    ],

    'common' => [
        'error' => 'Что-то пошло не так. Пожалуйста, повторите попытку позже.',
        'no-result-found' => 'Мы не смогли найти никаких записей.'
    ],

    'home' => [
        'name' => 'Главная',
        'page-title' => config('app.name') . ' - Главная',
        'featured-products' => 'Featured Products',
        'new-products' => 'Новинки и ',
        'bestsellers' => 'Бестселлеры',
        'verify-email' => 'Verify your email account',
        'resend-verify-email' => 'Resend Verification Email'
    ],

    'header' => [
        'help' => 'Помощь?',
        'title' => 'Account',
        'dropdown-text' => 'Manage Cart, Orders & Wishlist',
        'sign-in' => 'Войти',
        'sign-up' => 'Sign Up',
        'account' => 'Account',
        'cart' => 'Корзина',
        'profile' => 'Профиль',
        'wishlist' => 'Wishlist',
        'cart' => 'Корзина',
        'logout' => 'Logout',
        'search-text' => 'Поиск'
    ],

    'banner' => [
        'btn-title' => 'хочу подарок',
        'shopping-btn-title' => 'За покупками',
        'collections-btn-title' => 'Посмортеть в магазине',
        'btn-more-details' => 'подробно',
    ],

    'button' => [
        'read' => 'Читать',
        'buy' => 'Купить',
    ],

    'minicart' => [
        'view-cart' => 'Посмотреть корзину',
        'checkout' => 'Оформить заказ',
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
        'subscribe' => 'Подписатся на новости',
        'subscribed' => 'You are now subscribed to subscription emails.',
        'not-subscribed' => 'You can not be subscribed to subscription emails, please try again later.',
        'already' => 'You are already subscribed to our subscription list.',
        'unsubscribed' => 'You are unsubscribed from subscription mails.',
        'already-unsub' => 'You are already unsubscribed.',
        'not-subscribed' => 'Error! Mail can not be sent currently, please try again later.',
        'privacy-policy' => 'Политика конфиденциальности',
    ],

    'search' => [
        'no-results' => 'No Results Found',
        'page-title' => config('app.name') . ' - Поиск',
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
            'account_exists' => 'Уже есть аккаунт',
            'title' => 'Войти'
        ],

        'signup-form' => [
            'page-title' => 'Клиент - Регистрационная форма',
            'title' => 'Зарегистрироваться',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'email' => 'Email',
            'password' => 'Пароль',
            'confirm_pass' => 'Подтверждение пароля',
            'button_title' => 'Регистрация',
            'agree' => 'Agree',
            'terms' => 'Terms',
            'conditions' => 'Conditions',
            'using' => 'by using this website',
            'agreement' => 'Agreement',
            'success' => 'Аккаунт успешно создан.',
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
            'no_account' => 'Регистрация',
            'title' => 'Зарегистрироваться',
        ],

        'login-form' => [
            'page-title' => 'Вход для клиентов',
            'title' => 'Войти',
            'sub-title' => 'Введите логин и пароль',
            'email' => 'Email',
            'password' => 'Пароль',
            'forgot_pass' => 'Забыли пароль?',
            'button_title' => 'Войти',
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
                    'page-title' => 'Профиль пользователя',
                    'title' => 'Персональные данные',
                    'edit' => 'Редактировать',
                ],

                'edit-success' => 'Профиль успешно обновлен.',
                'edit-fail' => 'Error! Profile cannot be updated, please try again later.',
                'unmatch' => 'The old password does not match.',

                'fname' => 'Имя',
                'lname' => 'Фамилия',
                'gender' => 'Стать',
                'dob' => 'Дата рождения',
                'sub-dob' => 'мы хотим отправить Вам подарок',
                'phone' => 'Телефон',
                'email' => 'Email',
                'opassword' => 'Старый пароль',
                'password' => 'Пароль',
                'cpassword' => 'Подтверждение пароля',
                'submit' => 'Сохранить',
                'edit-profile' => [
                    'title' => 'Персональные данные - редактирование',
                    'page-title' => 'Клиент - Изменить форму профиля'
                ]
            ],

            'address' => [
                'index' => [
                    'page-title' => 'Customer - Address',
                    'title' => 'Address',
                    'add' => 'Добавить адрес',
                    'edit' => 'Edit',
                    'empty' => 'У вас нет сохраненных адресов здесь, попробуйте создать его, нажав на ссылку ниже',
                    'create' => 'Создать адрес',
                    'delete' => 'Удалить',
                    'make-default' => 'Make Default',
                    'default' => 'Default',
                    'contact' => 'Contact',
                    'confirm-delete' =>  'Do you really want to delete this address?',
                    'default-delete' => 'Default address cannot be changed.',
                    'enter-password' => 'Введите ваш пароль.',
                ],

                'create' => [
                    'page-title' => 'Клиент - Добавить адресную форму',
                    'title' => 'Добавить адрес',
                    'street-address' => 'Адрес улицы',
                    'country' => 'Страна',
                    'state' => 'Область',
                    'select-state' => 'Выберите регион, штат или провинцию',
                    'city' => 'Город',
                    'postcode' => 'Почтовый код',
                    'phone' => 'Телефон',
                    'submit' => 'Сохранить адрес',
                    'success' => 'Адрес был успешно добавлен.',
                    'error' => 'Адрес не может быть добавлен.'
                ],

                'edit' => [
                    'page-title' => 'Customer - Edit Address',
                    'title' => 'Редактировать адрес',
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
                    'page-title' => 'Клиент - Заказы',
                    'title' => 'История заказов',
                    'order_id' => 'ID Заказа',
                    'date' => 'Дата',
                    'status' => 'Статус',
                    'total' => 'Общая сумма',
                    'order_number' => 'Номер заказа'
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
                'order-id' => 'ID заказа',
                'date' => 'Дата',
                'name' => 'Title',
                'status' => 'Статус',
                'pending' => 'В ожидании',
                'available' => 'Доступниый',
                'expired' => 'Истекший',
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
        'layered-nav-title' => 'Фильтр',
        'price-label' => 'As low as',
        'remove-filter-link-title' => 'Очистить',
        'apply-filter-link-title' => 'Подтвердить',
        'sort-by' => 'Sort By',
        'from-a-z' => 'From A-Z',
        'from-z-a' => 'From Z-A',
        'newest-first' => 'Бестселлеры',
        'oldest-first' => 'Oldest First',
        'cheapest-first' => 'Cheapest First',
        'expensive-first' => 'Expensive First',
        'show' => 'Show',
        'show-more' => 'Показать больше товаров',
        'pager-info' => 'Showing :showing of :total Items',
        'description' => 'Описание',
        'specification' => 'Specification',
        'total-reviews' => ':total Reviews',
        'total-rating' => ':total_rating Ratings & :total_reviews Reviews',
        'by' => 'By :name',
        'up-sell-title' => 'We found other products you might like!',
        'related-product-title' => 'Вам также может ',
        'related-product-bottom' => 'Понравится',
        'cross-sell-title' => 'More choices',
        'reviews-title' => 'Ratings & Reviews',
        'write-review-btn' => 'Write Review',
        'choose-option' => 'Choose an option',
        'sale' => 'Sale',
        'new' => 'Новое',
        'empty' => 'No products available in this category',
        'add-to-cart' => 'Добавить товар',
        'buy-now' => 'Buy Now',
        'whoops' => 'Whoops!',
        'quantity' => 'Количество',
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
            'title' => 'Корзина',
            'name' => 'Товар',
            'empty' => 'Ваша корзина пуста',
            'update-cart' => 'Обновить корзину',
            'continue-shopping' => 'Продолжить покупки',
            'proceed-to-checkout' => 'Оформить заказ',
            'remove' => 'Удалить',
            'remove-link' => 'Удалить',
            'move-to-wishlist' => 'Move to Wishlist',
            'move-to-wishlist-success' => 'Item moved to wishlist.',
            'move-to-wishlist-error' => 'Cannot move item to wishlist, please try again later.',
            'add-config-warning' => 'Please select option before adding to cart.',
            'quantity' => [
                'quantity' => 'Количество',
                'short' => 'кол-во:',
                'success' => 'Содержание корзины успешно обновлено.',
                'illegal' => 'Quantity cannot be lesser than one.',
                'inventory_warning' => 'The requested quantity is not available, please try again later.',
                'error' => 'Cannot update the item(s) at the moment, please try again later.'
            ],

            'item' => [
                'error_remove' => 'Нет товаров для удаления из корзины.',
                'success' => 'Товар был успешно добавлен в корзину.',
                'success-remove' => 'Товар был успешно удален из корзины.',
                'error-add' => 'Товар не может быть добавлен в корзину, повторите попытку позже.',
            ],
            'quantity-error' => 'Requested quantity is not available.',
            'cart-subtotal' => 'Общая сумма',
            'cart-remove-action' => 'Do you really want to do this ?',
            'partial-cart-update' => 'Only some of the product(s) were updated',
            'link-missing' => ''
        ],
        'gift' => [
            'title' => 'Ваш подарок',
            'free' => 'Бесплатный подарок',
            'premium' => 'Премиальный подарок',
            'free-message' => 'Вы можете выбрать этот бесплатный подарок для заказа.',
            'premium-message' => 'Купите еще на %s и получите этот бесплатный подарок',
            'gift-change' => 'У Вас сменился подарок от суммы заказа.',
            'gift-selected' => 'Вами был выбран другой подарок.',
            'gift-available' => 'Поздравляем, теперь у Вас есть подарок.',
            'gift-not-available' => 'Очень жаль, но суммы заказа не хватает для получения подарка.',
        ],

        'onepage' => [
            'title' => 'Оформление заказа',
            'cart-title' => 'Ваш заказ',
            'information' => 'Данные',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'complete' => 'Завершение',
            'billing-address' => 'Адрес для выставления счета',
            'sign-in' => 'Войти',
            'first-name' => 'Имя',
            'last-name' => 'Фамилия',
            'email' => 'Email',
            'address1' => 'Улица',
            'city' => 'Город',
            'state' => 'Область',
            'select-state' => 'Select a region, state or province',
            'postcode' => 'Почтовый индекс',
            'phone' => 'Телефон',
            'country' => 'Страна',
            'order-summary' => 'Общая сумма',
            'shipping-address' => 'Адреса доставки',
            'use_for_shipping' => 'Отправьте по этому адресу',
            'continue' => 'Продолжить',
            'shipping-method' => 'Выберите способ доставки',
            'payment-methods' => 'Выберите способ оплаты',
            'payment-method' => 'Способ оплаты',
            'summary' => 'Итог заказа',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'contact' => 'Контакт',
            'place-order' => 'Разместить заказ',
            'new-address' => 'Добавить новый адрес',
            'save_as_address' => 'Сохранить как адрес',
            'apply-coupon' => 'Применить купон',
            'enter-coupon' => 'Введите код купона',
            'amt-payable' => 'Amount Payable',
            'got' => 'Got',
            'free' => 'Free',
            'coupon-used' => 'Купон используется',
            'applied' => 'Применяется',
            'back' => 'Back',
            'cash-desc' => 'Оплата при доставке',
            'money-desc' => 'Денежный перевод',
            'paypal-desc' => 'Paypal Standard',
            'free-desc' => 'Это бесплатная доставка',
            'flat-desc' => 'Это фиксированная ставка',
            'password' => 'Пароль',
            'login-exist-message' => 'У вас уже есть учетная запись, войдите или зарегистрируйтесь как гость.'
        ],

        'total' => [
            'order-summary' => 'Итог заказа',
            'sub-total' => 'Сумма заказа',
            'grand-total' => 'Общая сумма',
            'delivery-charges' => 'Расходы за доставку',
            'tax' => 'Налог',
            'discount' => 'Скидка',
            'price' => 'цена',
            'disc-amount' => 'Сумма со скидкой',
            'new-grand-total' => 'New Grand Total',
            'coupon' => 'Купон',
            'coupon-applied' => 'Купон применяется',
            'remove-coupon' => 'Удалить купон',
            'cannot-apply-coupon' => 'Не возможно применить купон'
        ],

        'success' => [
            'title' => 'Заказ успешно размещен',
            'thanks' => 'Спасибо за ваш заказ!',
            'order-id-info' => 'Ваш идентификатор заказа #: order_id',
            'info' => 'Мы вышлем вам ваши реквизиты и информацию для отслеживания'
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
