<?php
require_once 'config.php';
$page_title = 'سياسة الخصوصية';
include 'header.php';
?>

<!-- Page Header -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-12">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            <span class="gradient-text">سياسة الخصوصية</span>
        </h1>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
            نحن ملتزمون بحماية خصوصيتك وبياناتك الشخصية
        </p>
        <p class="text-sm text-gray-400 mt-4">
            آخر تحديث: <?php echo date('d F Y', strtotime('2025-10-25')); ?>
        </p>
    </div>
</section>

<!-- Privacy Content -->
<section class="py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-invert prose-primary max-w-none">
            <!-- Introduction -->
            <div class="mb-12">
                <p class="text-lg text-gray-300 leading-relaxed">
                    في Pyramedia، نحترم خصوصيتك ونلتزم بحماية معلوماتك الشخصية. توضح سياسة الخصوصية هذه كيفية جمع واستخدام وحماية المعلومات التي تقدمها لنا عند استخدام موقعنا الإلكتروني أو خدماتنا.
                </p>
            </div>

            <!-- Section 1 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">1</span>
                    المعلومات التي نجمعها
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <h3 class="text-xl font-semibold mb-3 text-primary">1.1 المعلومات الشخصية</h3>
                    <p class="text-gray-300 mb-4">قد نجمع المعلومات التالية:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-300 mr-4">
                        <li>الاسم الكامل</li>
                        <li>عنوان البريد الإلكتروني</li>
                        <li>رقم الهاتف</li>
                        <li>اسم الشركة ومنصبك</li>
                        <li>عنوان IP والموقع الجغرافي</li>
                        <li>معلومات المتصفح والجهاز</li>
                    </ul>

                    <h3 class="text-xl font-semibold mb-3 mt-6 text-primary">1.2 المعلومات التقنية</h3>
                    <p class="text-gray-300">
                        نجمع تلقائياً معلومات حول زيارتك للموقع، بما في ذلك الصفحات التي تزورها، ومدة الزيارة، ومصدر الإحالة، ونوع المتصفح والجهاز المستخدم.
                    </p>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">2</span>
                    كيفية استخدام المعلومات
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <p class="text-gray-300 mb-4">نستخدم المعلومات التي نجمعها للأغراض التالية:</p>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-white mb-1">تقديم الخدمات</h4>
                                <p class="text-sm text-gray-400">معالجة طلباتك وتقديم خدماتنا</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-white mb-1">التواصل</h4>
                                <p class="text-sm text-gray-400">الرد على استفساراتك وإرسال التحديثات</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-white mb-1">التحسين</h4>
                                <p class="text-sm text-gray-400">تحسين موقعنا وخدماتنا</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-white mb-1">التسويق</h4>
                                <p class="text-sm text-gray-400">إرسال عروض وأخبار (بموافقتك)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">3</span>
                    حماية المعلومات
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <p class="text-gray-300 mb-4">
                        نتخذ إجراءات أمنية صارمة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو التغيير أو الإفصاح أو التدمير:
                    </p>
                    <div class="grid md:grid-cols-3 gap-4 mt-6">
                        <div class="text-center p-4 bg-dark rounded-lg border border-primary/20">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold mb-1">تشفير SSL</h4>
                            <p class="text-sm text-gray-400">جميع البيانات مشفرة</p>
                        </div>
                        <div class="text-center p-4 bg-dark rounded-lg border border-primary/20">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold mb-1">وصول محدود</h4>
                            <p class="text-sm text-gray-400">فقط الموظفون المصرح لهم</p>
                        </div>
                        <div class="text-center p-4 bg-dark rounded-lg border border-primary/20">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold mb-1">مراجعة دورية</h4>
                            <p class="text-sm text-gray-400">تحديث الأمان المستمر</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">4</span>
                    ملفات تعريف الارتباط (Cookies)
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <p class="text-gray-300 mb-4">
                        نستخدم ملفات تعريف الارتباط لتحسين تجربتك على موقعنا. يمكنك التحكم في ملفات تعريف الارتباط من خلال إعدادات المتصفح.
                    </p>
                    <div class="bg-dark rounded-lg p-4 border-r-4 border-primary">
                        <p class="text-sm text-gray-300">
                            <strong class="text-primary">ملاحظة:</strong> تعطيل ملفات تعريف الارتباط قد يؤثر على بعض وظائف الموقع.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 5 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">5</span>
                    حقوقك
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <p class="text-gray-300 mb-4">لديك الحق في:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300">الوصول إلى معلوماتك الشخصية</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300">تصحيح أو تحديث معلوماتك</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300">حذف معلوماتك</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300">الاعتراض على معالجة بياناتك</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-300">إلغاء الاشتراك من الرسائل التسويقية</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Section 6 -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary">6</span>
                    التغييرات على السياسة
                </h2>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
                    <p class="text-gray-300">
                        قد نقوم بتحديث سياسة الخصوصية من وقت لآخر. سنقوم بإخطارك بأي تغييرات جوهرية عن طريق نشر السياسة الجديدة على هذه الصفحة وتحديث تاريخ "آخر تحديث" أعلاه.
                    </p>
                </div>
            </div>

            <!-- Contact -->
            <div class="bg-gradient-to-r from-primary/10 to-accent-gold/10 rounded-xl p-8 border border-primary/30">
                <h2 class="text-2xl font-bold mb-4">تواصل معنا</h2>
                <p class="text-gray-300 mb-6">
                    إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه أو كيفية تعاملنا مع معلوماتك، يرجى التواصل معنا:
                </p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">البريد الإلكتروني</p>
                            <a href="mailto:<?php echo CONTACT_EMAIL; ?>" class="text-primary hover:underline">
                                <?php echo CONTACT_EMAIL; ?>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">الهاتف</p>
                            <a href="tel:<?php echo CONTACT_PHONE; ?>" class="text-primary hover:underline">
                                <?php echo CONTACT_PHONE; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
