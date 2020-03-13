<?php

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/user.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 
$quiz = new Quiz();
$quiz->selectById(137);

$quizId = $quiz->getId();
$questions = $wpdb->get_results( "SELECT * FROM question WHERE id_quiz='$quizId'");
$quizArray = [];
print_r($questions); 

    $quiz = array(
        'id' => $quiz->getId(),
        'name' => $quiz->getName(),
        'tag_id' => $quiz->getTag()->getId(),
        'img' => $quiz->getImgPath(),
    );
    foreach($questions as $q){
        $question = array(  
            "id" => $q->id,
            "id_quiz" => $q->id_quiz,
            "content" => $q->content,
            "img_path" => $q->img_path,
            "url" => $q->url,
            "points" => $q->points,
        );
        
        $questionId = $question['id'];
        $answers = $wpdb->get_results( "SELECT * FROM answer where id_question='$questionId'" );
        print_r($answers); 
        foreach($answers as $a){
            $answer = array(
                'id' => $a->id,
                'id_question' => $a->id_question,
                'content' => $a->content,
                'is_true' => $a->is_true,
            );
            $question['answers'][] = $answer;
        }
        $quiz['questions'][] = $question;
    }


echo json_encode($quiz);




// //JSON encode
// $quiz = new Quiz();
// $quiz->selectById(135);

// // if(isset($_GET['id'])){
// //     $quiz = new Quiz();
// //     $quiz->selectById($_GET['id']);
// // }

// //on récupére les info du quiz et on les met dans un tableau $quiz
// $quiz = array(
//     'id' => $quiz->getId(),
//     'name' => $quiz->getName(),
//     'tag_id' => $quiz->getTag()->getId(),
//     'tag_name' => $quiz->getTag()->getName(),
//     'img' => $quiz->getImgPath(),
// );
// // $quiz => [ id , name, tag_id, tag_name, img ] 

// //on récupàre les questions du quiz et on boucle dessus
// $questions = $wpdb->get_results( "SELECT * FROM question WHERE id_quiz = '$quiz->getId()'");
// print_r($question);
// foreach($questions as $q){
//     //on récupére les infos de la question et on les met dans un tableau $question
//     $qTmp = new Question();
//     $qTmp->selectById($q->id);
//     $question = array(
//         "id" => $qTmp->getId(),
//         "id_quiz" => $qTmp->getIdQuiz(),
//         "content" => $qTmp->getContent(),
//         "img_path" => $qTmp->getImgPath(),
//         "url" => $qTmp->getUrl(),
//         "points" => $qTmp->getPoints(),
//     );
//     print_r($question);
//     // $question => [ id , id_quiz, content, img_path, url, points ] 
//     //on récupére les réponses de la question et on boucle dessus
//     $answers = $wpdb->get_results( "SELECT * FROM answer where id_question= '$q->id'" );
//     foreach($answers as $a){
//         //on récupére les info de la reponse et on les met dans un tableau $answer
//         $aTmp = new Answer();
//         $aTmp->selectById($a->id);
//         $answer = array(
//             'id' => $aTmp->getId(),
//             'id_question' => $aTmp->getIdQuestion(),
//             'content' => $aTmp->getContent(),
//             'is_true' => $aTmp->getIsTrue(),
//         );
//         // $answer => [ id , id_question, content, is_true ]
//         print_r($answer);
//         //  on stock chaque réponse dans un sous tableau de $question
//         $question['answers'][] = $answer;
//         print_r( $question);
//         // $question=> [ 
//         //     id , 
//         //     id_quiz, 
//         //     content, 
//         //     img_path, 
//         //     url, 
//         //     points , 
//         //     answers[
//         //         [ id , id_question, content, is_true ],
//         //         ... (fois le nombre de réponse)
//         //     ]
//         // ] 
//     }
//     //  on stock chaque question dans un sous tableau de $quiz
//     $quiz['questions'][] = $question;
//     // $quiz => [ 
//     //     id , 
//     //     name, 
//     //     tag_id, 
//     //     tag_name, 
//     //     img,
//     //     questions[
//     //          [ 
//     //               id , 
//     //               id_quiz, 
//     //               content, 
//     //               img_path, 
//     //               url, 
//     //               points , 
//     //               answers[
//     //                      [ id , id_question, content, is_true ],
//     //                      [ id , id_question, content, is_true ],
//     //                      [ id , id_question, content, is_true ],
//     //                      [ id , id_question, content, is_true ],
//     //              ]
//     //          ],
//     //          ... (fois le nombre de question)
//     //     ]
//     // ] 
// }

// echo json_encode($quiz);

?>