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
        'resend-verify-email' => 'Resend Verification Email',
        'shop-now' => 'Купить сейчас'
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
        'no-results' => 'Результаты не найдены',
        'page-title' => config('app.name') . ' - Поиск',
        'found-results' => 'Результаты поиска найдены',
        'found-result' => 'Результат поиска найден'
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
            'title' => 'Восстановить пароль',
            'email' => 'Email',
            'submit' => 'Подтвердить',
            'page_title' => 'Customer - Forgot Password Form'
        ],

        'reset-password' => [
            'title' => 'Сброс пароля',
            'email' => 'Зарегистрированная электронная почта',
            'password' => 'Пароль',
            'confirm-password' => 'Подтвердите Пароль',
            'back-link-title' => 'Вернуться к входу',
            'submit-btn-title' => 'Сброс пароля'
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
                    'make-default' => 'Использовать по умолчанию',
                    'default' => 'По умолчанию',
                    'contact' => 'Контакт',
                    'confirm-delete' =>  'Вы действительно хотите удалить этот адрес?',
                    'default-delete' => 'Адрес по умолчанию не может быть изменен.',
                    'enter-password' => 'Введите ваш пароль.',
                    'address-id' => 'ID Адреса',
                    'address-1' => 'Адрес',
                    'city' => 'Город',
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
                    'page-title' => 'Клиент - Редактирование адреса',
                    'title' => 'Редактировать адрес',
                    'street-address' => 'Адрес улицы',
                    'submit' => 'Сохранить адрес',
                    'success' => 'Адрес успешно обновлен.',
                ],
                'delete' => [
                    'success' => 'Адрес успешно удален',
                    'failure' => 'Адрес не может быть удален',
                    'wrong-password' => 'Неправильный пароль !'
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

                'status' => [
                    'processing' => 'Обработка',
                    'completed' => 'Завершенный',
                    'canceled' => 'Отменен',
                    'closed' => 'Закрыто',
                    'pending' => 'В ожидании',
                    'pending-payment' => 'Ожидающий платеж',
                    'fraud' => 'Мошенничество'
                ],

                'view' => [
                    'page-tile' => 'Заказ #:order_id',
                    'info' => 'Информация',
                    'placed-on' => 'Создан',
                    'products-ordered' => 'Продукты заказа',
                    'invoices' => 'Счета-фактуры',
                    'shipments' => 'Отгрузки',
                    'SKU' => 'SKU',
                    'product-name' => 'Наименование',
                    'qty' => 'Кол-во',
                    'item-status' => 'Состояние товара',
                    'item-ordered' => 'Заказано (:qty_ordered)',
                    'item-invoice' => 'Факт (:qty_invoiced)',
                    'item-shipped' => 'Отправленно (:qty_shipped)',
                    'item-canceled' => 'Отменено (:qty_canceled)',
                    'item-refunded' => 'Повернуто (:qty_refunded)',
                    'price' => 'Цена',
                    'gift' => 'Бесплатный подарок',
                    'total' => 'Общее количество',
                    'subtotal' => 'Подитог',
                    'shipping-handling' => 'Отправка & Обработка',
                    'tax' => 'Налог',
                    'discount' => 'Скмдка',
                    'tax-percent' => 'Процент налога',
                    'tax-amount' => 'Сумма налога',
                    'discount-amount' => 'Сумма скидки',
                    'grand-total' => 'Общая сумма',
                    'total-paid' => 'Итого',
                    'total-refunded' => 'Всего возмещено',
                    'total-due' => 'Итого к оплате',
                    'shipping-address' => 'Адрес получателя',
                    'billing-address' => 'Адрес Отправки',
                    'shipping-method' => 'Способ отправки',
                    'payment-method' => 'Способ оплаты',
                    'individual-invoice' => 'Счет #:invoice_id',
                    'individual-shipment' => 'Отгрузка #:shipment_id',
                    'print' => 'Печать',
                    'invoice-id' => 'Счет-фактура Id',
                    'order-id' => 'Заказ Id',
                    'order-date' => 'Дата заказа',
                    'bill-to' => 'Счет до',
                    'ship-to' => 'Доставка до',
                    'contact' => 'Контактные данные',
                    'refunds' => 'Возвраты',
                    'individual-refund' => 'Возврат #:refund_id',
                    'adjustment-refund' => 'Корректировка Возврата',
                    'adjustment-fee' => 'Плата за корректировку',
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
        'price-label' => 'Так низко, как',
        'remove-filter-link-title' => 'Очистить',
        'apply-filter-link-title' => 'Подтвердить',
        'sort-by' => 'Сортировать по',
        'from-a-z' => 'Из А-Я',
        'from-z-a' => 'Из Я-А',
        'newest-first' => 'Бестселлеры',
        'oldest-first' => 'Сначала старые',
        'cheapest-first' => 'Самый дешевый первый',
        'expensive-first' => 'Дорогой первый',
        'show' => 'Показать',
        'show-more' => 'Показать больше товаров',
        'pager-info' => 'Showing :showing of :total Items',
        'description' => 'Описание',
        'specification' => 'Спецификация',
        'total-reviews' => ':total Reviews',
        'total-rating' => ':total_rating Ratings & :total_reviews Reviews',
        'by' => 'By :name',
        'up-sell-title' => 'Мы нашли другие продукты, которые вам могут понравиться!',
        'related-product-title' => 'Вам также может ',
        'related-product-bottom' => 'Понравится',
        'cross-sell-title' => 'Больше вариантов',
        'reviews-title' => 'Рейтинги и обзоры',
        'write-review-btn' => 'Написать отзыв',
        'choose-option' => 'Выберите опцию',
        'sale' => 'Распродажа',
        'new' => 'Новое',
        'empty' => 'В этой категории нет товаров',
        'add-to-cart' => 'Добавить товар',
        'buy-now' => 'Купить сейчас',
        'whoops' => 'Whoops!',
        'quantity' => 'Количество',
        'in-stock' => 'In Stock',
        'out-of-stock' => 'Out Of Stock',
        'view-all' => 'Посмотреть все',
        'select-above-options' => 'Пожалуйста, сначала выберите выше варианты.',
        'less-quantity' => 'Количество не может быть меньше единицы.',
        'samples' => 'Образцы',
        'links' => 'Связи',
        'sample' => 'Образец',
        'name' => 'Наименование',
        'qty' => 'К-во',
        'starting-at' => 'Начинается с',
        'customize-options' => 'Настроить параметры',
        'choose-selection' => 'Зделайте выбор',
        'your-customization' => 'Ваша настройка',
        'total-amount' => 'Общее количество',
        'none' => 'Ни один',
        'weight-unit' => 'мл',
        'show-more' => 'Показать больше'
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
                'illegal' => 'Количество не может быть меньше единицы.',
                'inventory_warning' => 'Запрашиваемое количество недоступно, повторите попытку позже.',
                'error' => 'Не удается обновить элементы в данный момент, повторите попытку позже.'
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
            'hail' => 'Поздравляєм!',
            'regret-sorry' => 'Нам очень жаль!',
            'regret' => 'Но Вы потеряли  возможность получить бесплатно (:product_name)',
            'regret-premium' => 'Добавьте дополнительно любое любимое средство в корзину на сумму ":premium_counter" и порадуйте себя подарком, чтобы улучшить свой уход!',
            'available' => 'мы добавили этот бесплатный :product_name в вашу корзину.',
            'free' => 'Бесплатный подарок',
            'premium' => 'Премиальный подарок',
            'free-message' => 'Вы можете выбрать этот бесплатный подарок для заказа.',
            'premium-message' => 'Купите еще на :premium_counter и получите этот бесплатный подарок',
            'premium-gift' => 'Купите еще на :premium_counter и более и выберите подарок премиум-класса.',
            'gift-change' => 'У Вас сменился подарок от суммы заказа.',
            'gift-selected' => 'Вы успешно изменили подарок.',
            'gift-available' => 'Поздравляем, теперь у Вас есть подарок.',
            'gift-not-available' => 'Нам очень жаль, но суммы заказа не хватает для получения подарка.',
            'gift-lost-available' => 'Нам очень жаль, но Вы потеряли свой подарок.',
            'gift-change-error' => 'Ошыбка получения подарка.',
        ],

        'onepage' => [
            'title' => 'Оформление заказа',
            'cart-title' => 'Ваш заказ',
            'information' => 'Данные',
            'shipping' => 'Доставка',
            'payment' => 'Оплата',
            'complete' => 'Завершение',
            'billing-address' => 'Данные плательщика',
            'sign-in' => 'Войти',
            'first-name' => 'Имя',
            'last-name' => 'Фамилия',
            'email' => 'Email',
            'address1' => 'Адрес доставки/Отделение Новой Почты',
            'address2' => 'Отделение Новой Почты',
            'city' => 'Город',
            'state' => 'Область',
            'select-state' => 'Select a region, state or province',
            'postcode' => 'Почтовый индекс',
            'phone' => 'Телефон',
            'country' => 'Страна',
            'order-summary' => 'Общая сумма',
            'shipping-address' => 'Данные получателя',
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
            'apply-coupon' => 'Активировать',
            'enter-coupon' => 'Введите код купона',
            'amt-payable' => 'Amount Payable',
            'got' => 'Got',
            'free' => 'Free',
            'coupon-used' => 'Купон используется',
            'applied' => 'Применяется',
            'back' => 'Назад',
            'cash-desc' => 'Оплата при доставке',
            'money-desc' => 'Денежный перевод',
            'paypal-desc' => 'Paypal Standard',
            'liqpay-desc' => 'LiqPay платежная система',
            'free-desc' => 'Это бесплатная доставка',
            'flat-desc' => 'Это фиксированная ставка',
            'password' => 'Пароль',
            'login-exist-message' => 'У вас уже есть учетная запись, войдите или зарегистрируйтесь как гость.',
            'address-message' => 'Здесь указываем адрес доставки. Для НОВОЙ ПОЧТЫ указываем номер отделения в поле - улица.',
            'enter-coupon-code' => 'Подарочный купон'
        ],

        'total' => [
            'order-summary' => 'Итог заказа',
            'sub-total' => 'Сумма заказа',
            'grand-total' => 'Общая сумма',
            'delivery-charges' => 'Расходы за доставку',
            'tax' => 'Налог',
            'discount' => 'Скидка',
            'price' => 'цена',
            'disc-amount' => 'Сумма скиди',
            'new-grand-total' => 'New Grand Total',
            'coupon' => 'Купон',
            'coupon-applied' => 'Купон применяется',
            'remove-coupon' => 'Удалить купон',
            'cannot-apply-coupon' => 'Не возможно применить купон',
            'invalid-coupon' => 'Код купона недействителен.',
            'success-coupon' => 'Код купона успешно применен.',
            'coupon-apply-issue' => 'Код купона не может быть применен.'
        ],

        'success' => [
            'title' => 'Заказ успешно размещен',
            'thanks' => 'Спасибо за ваш заказ!',
            'order-id-info' => 'Ваш идентификатор заказа #:order_id',
            'info' => 'Мы вышлем вам ваши реквизиты и информацию для отслеживания'
        ]
    ],

    'mail' => [
        'order' => [
            'subject' => 'Подтверждение нового заказа',
            'heading' => 'Подтверждение заказа!',
            'new-heading' => 'Ваш заказ',
            'dear' => 'Уважаемый(ая) :customer_name',
            'dear-admin' => 'Уважаемый(ая) :admin_name',
            'greeting' => 'Спасибо за ваш заказ :order_id создан :created_at',
            'greeting-admin' => 'Заказ Id :order_id создан :created_at',
            'summary' => 'Итог Заказа',
            'shipping-address' => 'Адрес доставки',
            'billing-address' => 'Адрес плательщика',
            'contact' => 'Контактные данные',
            'shipping' => 'Способ доставки',
            'payment' => 'Способ оплаты',
            'price' => 'Цена',
            'gift' => 'Бесплатный подарок',
            'quantity' => 'Количество',
            'subtotal' => 'Подитог',
            'shipping-handling' => 'Доставка',
            'tax' => 'Налог',
            'discount' => 'Скидка',
            'grand-total' => 'Общая сумма',
            'final-summary' => 'Спасибо за проявленный интерес к нашему магазину. Мы вышлем вам номер для отслеживания после его отправки.',
            'help' => 'Если вам нужна помощь, пожалуйста, свяжитесь с нами по адресу :support_email',
            'thanks' => 'Спасибо!',

            'cancel' => [
                'subject' => 'Подтверждение отмены Заказа',
                'heading' => 'Заказ отменен',
                'dear' => 'Уважаемый(ая) :customer_name',
                'greeting' => 'Ваш заказ id #:order_id создан :created_at был отменён',
                'summary' => 'Итог Заказа',
                'shipping-address' => 'Адрес получателя',
                'billing-address' => 'Адрес плательщика',
                'contact' => 'Контактные данные',
                'shipping' => 'Способ доставки',
                'payment' => 'Способ оплаты',
                'subtotal' => 'Подитог',
                'shipping-handling' => 'Доставка & Обработка',
                'tax' => 'Налог',
                'discount' => 'Скидка',
                'grand-total' => 'Общая сумма',
                'final-summary' => 'Спасибо за проявленный интерес к нашему магазину',
                'help' => 'Если вам нужна помощь, пожалуйста, свяжитесь с нами по адресу :support_email',
                'thanks' => 'Спасибо!',
            ],
            'menu' => [
                'products' => 'Товары',
                'collections' => 'Коллекции',
                'gifts' => 'Подарки',
                'about-us' => 'О нас',
            ],
        ],

        'invoice' => [
            'heading' => 'Ваш счет #:invoice_id на Заказ #:order_id',
            'subject' => 'Счет за ваш Заказ #:order_id',
            'summary' => 'Итого по счету',
        ],

        'shipment' => [
            'heading' => 'Отгрузка #:shipment_id был создан для заказа #:order_id',
            'inventory-heading' => 'Новый номер отгрузки #:shipment_id был сгенерирован для заказа #:order_id',
            'subject' => 'Отгрузка для вашего заказа #:order_id',
            'inventory-subject' => 'Для отправки был создан заказ #:order_id',
            'summary' => 'Резюме отгрузки',
            'carrier' => 'Перевозчик',
            'tracking-number' => 'Номер для отслеживания',
            'greeting' => 'Заказ :order_id был отправлен :created_at',
        ],

        'refund' => [
            'heading' => 'Ваш возврат #:refund_id для заказа #:order_id',
            'subject' => 'Возврат денег за ваш заказ #:order_id',
            'summary' => 'Итог возврата',
            'adjustment-refund' => 'Корректировка Возврат',
            'adjustment-fee' => 'Плата за корректировку'
        ],

        'forget-password' => [
            'subject' => 'Клиент сбросил пароль',
            'dear' => 'Уважаемый(ая) :name',
            'info' => 'Вы получаете это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи',
            'reset-password' => 'Сброс пароля',
            'final-summary' => 'Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется',
            'thanks' => 'Дякую!'
        ],

        'customer' => [
            'new' => [
                'dear' => 'Уважаемый(ая) :customer_name',
                'username-email' => 'Имя пользователя / Электронная почта',
                'subject' => 'Регистрация нового клиента',
                'password' => 'Пароль',
                'summary' => 'Ваш аккаунт был создан.
                Детали вашего аккаунта ниже: ',
                'thanks' => 'Спасибо!',
            ],

            'registration' => [
                'subject' => 'Регистрация нового клиента',
                'customer-registration' => 'Клиент успешно зарегистрирован',
                'dear' => 'Уважаемый(ая) :customer_name',
                'greeting' => 'Добро пожаловать и спасибо за регистрацию у нас!',
                'summary' => 'Ваша учетная запись была успешно создана, и вы можете войти, используя свой адрес электронной почты и пароль. После входа в систему вы сможете получить доступ к другим услугам, включая просмотр прошлых заказов, списков пожеланий и редактирование информации о вашей учетной записи..',
                'thanks' => 'Спасибо!',
            ],

            'verification' => [
                'heading' => config('app.name') . ' - Подтверждение адреса электронной почты',
                'subject' => 'Письмо с подтверждением',
                'verify' => 'Подтвердите ваш аккаунт',
                'summary' => 'Это письмо, подтверждающее, что введенный вами адрес электронной почты принадлежит вам.
                 Пожалуйста, нажмите кнопку Подтвердить свою учетную запись ниже, чтобы подтвердить свою учетную запись.'
            ],

            'subscription' => [
                'subject' => 'Подписка на Email',
                'greeting' => ' Добро пожаловать в ' . config('app.name') . ' - Email подписки',
                'unsubscribe' => 'Отказаться от подписки',
                'summary' => 'Спасибо, что поместили меня в свой почтовый ящик. Прошло много времени с тех пор, как вы прочитали ' . config('app.name') . ' email, и мы не хотим перегружать ваш почтовый ящик. Если вы все еще не хотите получать
                 последние новости маркетинга по электронной почте, затем обязательно нажмите кнопку ниже.'
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
