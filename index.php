<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined">

        <!-- Page Style -->
        <link rel="stylesheet" href="/css/home.css">

        <!-- Page Icon -->
        <link rel="shortcut icon" href="#" type="image/x-icon">

        <!-- Page Title -->
        <title>تدريب | برمجة الأجهزة الذكية</title>
    </head>
    <body>

        <!-- Computer Warning -->
        <div class="warning">
            <!-- Warring Icon -->
            <span class="material-icons-outlined">warning</span>

            <!-- Header&Paragraph Text -->
            <h2>المعذرة,هناك خطأ!</h2>
            <p>عذراً,لأستخدام الموقع يرجى الدخول من خلال هاتفك المحمول.</p>

            <!-- Developers Name --> 
            <span>
                فهد محمد الخالدي 
                &nbsp | &nbsp
                بندر عبدالرحمن الحملي
            </span>
        </div>

        
        <!-- Mobile Content -->
        <div class="mobile-container">
            <!-- Navbar -->
            <nav class="navbar">
                <!-- Info Icon -->
                <span class="material-icons-outlined" onclick="infoContainerToggle()">info</span>
            
                <!-- If The User Click Info icon -->
                <div class="info-container hide-info-container" id="info-container">
                    <!-- Close Icon -->
                    <span class="material-icons-outlined" onclick="infoContainerToggle()">close</span>

                    <!-- Note -->
                    <p>ان الموقع,تم تطويره لإحتواء أكبر قدر من الأسئلة الممكنة والمتاحه ولا يعتبر خيار بديل بشكل كامل للمذاكرة من خلاله,انما مجرد خيار أضافي.</p>
                
                    <!-- Developers Name --> 
                    <span>
                        فهد محمد الخالدي 
                        &nbsp | &nbsp
                        بندر عبدالرحمن الحملي
                    </span>
                </div>
            </nav>

            <!-- Header Container -->
            <section class="header-container">
                <!-- Header&Paragraph Text -->
                <h1>اهلاً,بتدريب.</h1>
                <p>قيم مستواك ببرمجة الأجهزة الذكيه!</p>
            </section>

            <!-- Body Container -->
            <section class="body-container">
                <!-- Summaries Container -->
                <div class="summaries-container">
                    <h2>الملفات</h2>

                    <!-- Files Container -->
                    <div class="files-container">
                        <a href="/pdf/intro.pdf">
                            <span class="material-icons-outlined file-icon">description</span>
                            <span>مقدمة</span>
                        </a>

                        <a href="/pdf/interface.pdf">
                            <span class="material-icons-outlined file-icon">description</span>
                            <span>التصميم</span>
                        </a>

                        <a href="/pdf/programming.pdf">
                            <span class="material-icons-outlined file-icon">description</span>
                            <span>البرمجة</span>
                        </a>

                        <a href="/pdf/pages.pdf">
                            <span class="material-icons-outlined file-icon">description</span>
                            <span>الصفحات</span>
                        </a>

                        <a href="/pdf/project.pdf">
                            <span class="material-icons-outlined file-icon">description</span>
                            <span>مشروع</span>
                        </a>


                    </div>
                </div>

                <!-- Exams Container -->
                <div class="exams-container">
                    <h2>الإختبارات</h2>

                    <!-- Exam Container -->
                    <div class="exam-container">
                        <!-- Exam -->
                        <div class="exam">
                            <!-- Exam Checkbox -->
                            <input type="checkbox" name="" id="">

                            <!-- Exan Details -->
                            <a href="/مقدمة-لنظام-الإندرويد" class="exam-details">
                                <h2>المقدمة لنظام الأندرويد</h2>
                                <span>10 أسئلة</span>
                            </a>
                        </div>

                        <!-- Exam -->
                        <div class="exam">
                            <!-- Exam Checkbox -->
                            <input type="checkbox" name="" id="">

                            <!-- Exan Details -->
                            <a href="/معمارية-برامج-الإندرويد" class="exam-details">
                                <h2>معمارية برامج الإندرويد</h2>
                                <span>10 أسئلة</span>
                            </a>
                        </div>

                        <!-- Exam -->
                        <div class="exam">
                            <!-- Exam Checkbox -->
                            <input type="checkbox" name="" id="">

                            <!-- Exan Details -->
                            <a href="/الواجهات-في-الزامرن" class="exam-details">
                                <h2>الواجهات في الزامرن</h2>
                                <span>10 أسئلة</span>
                            </a>
                        </div>

                        <!-- Exam -->
                        <div class="exam">
                            <!-- Exam Checkbox -->
                            <input type="checkbox" name="" id="">

                            <!-- Exan Details -->
                            <a href="/تصميم-البرنامج" class="exam-details">
                                <h2>تصميم البرنامج</h2>
                                <span>10 أسئلة</span>
                            </a>
                        </div>

                        <!-- Exam -->
                        <div class="exam">
                            <!-- Exam Checkbox -->
                            <input type="checkbox" name="" id="">

                            <!-- Exan Details -->
                            <a href="/الخدمات" class="exam-details">
                                <h2>الخدمات</h2>
                                <span>10 أسئلة</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
            
                
            </section>


            
        </div>
        

        <!-- JavaScript -->
        <script>
            // Declare Some Vars
            infoContainer = document.querySelector("#info-container");
            console.log(infoContainer);

            // When The User Click Info Icon in Navbar
            function infoContainerToggle() {
                infoContainer.classList.toggle("hide-info-container")
            }


        </script>
    
    </body>
</html>