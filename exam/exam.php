<?php
// Show Error
error_reporting(-1);
ini_set('display_errors',-1);

// Connect To Database
$mysql = new mysqli('localhost','root','','exam');

// Char Set
$mysql->set_charset("utf8");

// If There No Param With Unit Name
if (!isset($_GET['unit'])) {
    header('location: /');
    die();
}

// Get Unit Name&Code
switch ($_GET['unit']) {
    case 'مقدمة-لنظام-الإندرويد':
        $unitName = "مقدمة لنظام الإندرويد";
        $unitCode = 1;
        break;
    case 'معمارية-برامج-الإندرويد':
        $unitName = "معمارية برامج الإندرويد";
        $unitCode = 2;
        break;
    case 'الواجهات-في-الزامرن':
        $unitName = "الواجهات في الزامرن";
        $unitCode = 3;
        break;
    case 'تصميم-البرنامج':
        $unitName = "تصميم البرنامج";
        $unitCode = 4;
        break;
    case 'الخدمات':
        $unitName = "الخدمات";
        $unitCode = 5;
        break;
    default:
        header('location: /');
        die();
        break;
}

// Function To Get Random Questions
function getQuestions() : array{
    global $mysql,$unitCode;

    // Set Query Template
    $questions = $mysql->prepare("SELECT questions.id as 'question_id' , questions.question , questions.unit FROM `questions` WHERE unit = ? ORDER BY RAND() LIMIT 10;");

    // Set Parameters Of The Query
    $questions->bind_param("i",$unitCode);

    // Executing the query
    $questions->execute();

    // Filter The Result
    $questions = $questions->get_result();
    $questions = $questions->fetch_all(MYSQLI_ASSOC);

    // Set Answers For Each Question
    foreach ($questions as $key => $question) {
        // Get Answers
        $questionAnswers = getAnswers($question['question_id']);

        // Save All Answers
        // $questions[$key]['answers'] = array(...$questionAnswers);
        array_merge($questions[$key]['answers'],$questionAnswers);


        // Right Answer
        $rightAnswer = array($questions[$key]['answers'][0]);

        // Unset Right Answer
        unset($questions[$key]['answers'][0]);

        // Sort Array Answers 
        ksort($questions[$key]['answers']);

        // Get Random Postion
        $randomPostion = rand(1,4);

        // Add Right Answer To Answers
        array_splice($questions[$key]['answers'] , $randomPostion , 0 , $rightAnswer);

    }

    return $questions;
}

// Function To All Answers
function getAnswers(int $questionId){
    global $mysql;

    // Set Query Template
    $answers = $mysql->prepare("SELECT id as 'answer_id' , answer FROM `answers` WHERE question_id = ? ORDER BY RAND() LIMIT 1;");

    // Set Parameters Of The Query
    $answers->bind_param("i",$questionId);

    // Executing the query
    $answers->execute();

    // Filter The Result
    $answers = $answers->get_result();
    $answers = $answers->fetch_all(MYSQLI_ASSOC);

    // Save All Answers
    array_push($answers,...wrongAnswers($questionId));

    return $answers;
}

// Function To Set Wrong Answers
function wrongAnswers(int $questionId) : array{
    global $mysql;

    // Set Query Template
    $wrongAnswer = $mysql->prepare("SELECT id as 'answer_id' , answer FROM `answers` WHERE question_id != ? ORDER BY RAND() LIMIT 3;");

    // Set Parameters Of The Query
    $wrongAnswer->bind_param("i",$questionId);

    // Executing the query
    $wrongAnswer->execute();

    // Filter The Result
    $wrongAnswer = $wrongAnswer->get_result();
    $wrongAnswer = $wrongAnswer->fetch_all(MYSQLI_ASSOC);

    return $wrongAnswer;
}

// Function To Check Answers
function checkAnswers() : array{
    global $mysql;
    
    // Save Result
    $result = array();

    // Check From All Answers
    foreach ($_POST as $questionId => $answerId) {
        // Get Question Id And Answer Id
        $questionId = intval($questionId);
        $answerId   = intval($answerId);
        

        // Check From Answer
        $cheackAnswer = checkAnswer($questionId,$answerId);
        $answerStatus = [ $questionId , $answerId ,  $cheackAnswer ];

        // Save Answer Result
        array_push($result,$answerStatus);
    }


    return $result;
}

// Function To Check Answer
function checkAnswer(int $questionId , int $answerId) : bool{
    global $mysql;

    // Set Query Template
    $checkAnswer = $mysql->prepare("SELECT * FROM answers WHERE question_id = ? && id = ?;");

    // Set Parameters Of The Query
    $checkAnswer->bind_param("ii",$questionId,$answerId);

    // Executing the query
    $checkAnswer->execute();

    // Filter The Result
    $checkAnswer = $checkAnswer->get_result();
    $checkAnswer = $checkAnswer->fetch_all(MYSQLI_ASSOC);

    // If The Answer Is Wrong,Return False
    if (empty($checkAnswer)) {
        return false;
    }

    // Return True
    return true;
}

// Get Questions
$getQuestions = getQuestions();

// Get Result
$result = checkAnswers();

// Count Correct Answers
if ( !empty($result) ) {
    // To Count Correct Answers
    $correctAnswers = 0;

    // Start Count Correct Answers
    foreach ($result as $question => $answer) {
        
        // Check If The Answer Is Correct Or Not
        if ($answer[2] == true) {
            $correctAnswers += 1;
        }
        
    }
}


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined">

        <!-- Page Style -->
        <link rel="stylesheet" href="/css/exam.css">

        <!-- Page Icon -->
        <link rel="shortcut icon" href="#" type="image/x-icon">

        <!-- Page Title -->
        <title>اختبار في <?= $unitName ?></title>
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
                <!-- Page Back Icon -->
                <span class="material-icons-outlined" onclick="window.location='/'">east</span>

                <!-- Exam Title -->
                <p><?= $unitName ?></p>
            </nav>

            <!-- Body Container -->
            <section class="body-container">        
                <!-- Question Container -->
                <form method="POST" action="" class="question-container">
                    
                    <?php foreach ($getQuestions as $key => $question) { ?>
                       <!-- Question -->
                        <div class="question">
                            <h2><?= $key + 1 ?>- <?= $question['question'] ?></h2>

                            <div class="answer">
                                <input type="radio" name="<?= $question['question_id'] ?>"  id="<?= "q" . $question['question_id'] . "-a" . $question['answers'][0]['answer_id'] ?>" value="<?= $question['answers'][0]['answer_id'] ?>"> 
                                <label for="<?= "q" . $question['question_id'] . "-a" . $question['answers'][0]['answer_id'] ?>" ><?= $question['answers'][0]['answer'] ?></label>
                            </div>
                            
                            <div class="answer">
                                <input type="radio" name="<?= $question['question_id'] ?>"  id="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][1]['answer_id'] ?>" value="<?= $question['answers'][1]['answer_id'] ?>"> 
                                <label for="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][1]['answer_id'] ?>" ><?= $question['answers'][1]['answer'] ?></label>
                            </div>

                            <div class="answer">
                                <input type="radio" name="<?= $question['question_id'] ?>"  id="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][2]['answer_id'] ?>" value="<?= $question['answers'][2]['answer_id'] ?>"> 
                                <label for="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][2]['answer_id'] ?>" ><?= $question['answers'][2]['answer'] ?></label>
                            </div>

                            <div class="answer">
                                <input type="radio" name="<?= $question['question_id'] ?>"  id="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][3]['answer_id'] ?>" value="<?= $question['answers'][3]['answer_id'] ?>"> 
                                <label for="<?= "q" . $question['question_id'] . "-a" .  $question['answers'][3]['answer_id'] ?>" ><?= $question['answers'][3]['answer'] ?></label>
                            </div>       

                        </div> 
                    <?php } ?>

                    
                    <input type="submit" value="إنهاء الأختبار">
                </form>
            </section>

            <?php if( !empty($result) ){ ?>
                <!-- Result Section -->
                <section class="result-container">
                    <!-- Home Icon -->
                    <span class="material-icons-outlined" onclick="window.location='/'">close</span>

                    <!-- Note -->
                    <p>
                        درجتك هي 
                        <?= $correctAnswers ?>
                        من 
                        <?= count($result) ?>
                        درجات</p>
                    
                    <!-- Developers Name --> 
                    <span>
                        فهد محمد الخالدي 
                        &nbsp | &nbsp
                        بندر عبدالرحمن الحملي
                    </span>
                </section>
            <?php } ?>

            
        </div>
        
    
    </body>
</html>
