<?php

$lawful_bases = array(
    'consent' => 'Consent',
    'contractual' => 'Contractual',
    'legal_obligation' => 'Legal Obligation',
    'vital_interests' => 'Vital Interests',
    'public_task' => 'Public Task',
    'legitimate_interests' => 'Legitimate Interests'
    );

function loadCustomFormTemplate() {
    return TwigManager::getInstance()->load('project/customforms.html');
}

function alpaca_field($name, $data= null) {
    //if (!@$data) {
    //    $data = "[]";
    //}

    $tmpl = loadCustomFormTemplate();

    return $tmpl->renderBlock('alpaca_field', array('name' => $name, 'data' => $data));
}

function get_sanitized_name($value) {
    return preg_replace('/[^\w\d]+/', '_', strtolower($value));
}


function customform($slide, $original, $project, $recap=false) {  // original json data

    # get previous answer data
    $Slide = new Slide();

    switch($slide) {
    case "2.2":
    case "2.3":
    case "2.4":
        $previous = $Slide->findPreviousAnswer($project, 2, 1);
        break;
    default: die("unknown slide $slide"); break;
    };
    $previousanswer = json_decode($previous->answer, TRUE);

    switch($slide) {
    case "2.2": return customform_2_2($original, $previousanswer, $recap); break;
    case "2.3": return customform_2_3($original, $previousanswer, $recap); break;
    case "2.4": return customform_2_4($original, $previousanswer, $recap); break;
    }

}

function customform_2_2($answer, $previousanswer, $recap) {
    if ($recap) {
        $template = 'customform_2_2_recap';
    } else {
        $template = 'customform_2_2';
    }
    $tmpl = loadCustomFormTemplate();

    return $tmpl->renderBlock($template, array(
        'categories' => $previousanswer['data_collected'],
        'answer' => $answer
    ));
}


function customform_2_3($answer, $previousanswer, $recap) {
    global $lawful_bases;

    if ($recap) {
        return customform_2_3_recap($answer, $previousanswer);
    }

    $twig = TwigManager::getInstance();
    $s = $twig->render('forms/customform_2.3.html', array(
        'lawful_bases' => $lawful_bases,
        'answer' => $answer,
        'categories' => $previousanswer['data_collected']
    ));
    return $s;

}

function customform_2_3_recap($answer, $previousanswer) {
    global $lawful_bases;

    $twig = TwigManager::getInstance();

    return $twig->render('forms/customform_2.3_recap.html', array(
        'lawful_bases' => $lawful_bases,
        'answer' => $answer,
        'categories' => $previousanswer['data_collected']
    ));

}

function customform_2_4($answer, $previousanswer, $recap) {
    if ($recap) {
        return customform_2_4_recap($answer, $previousanswer);
    }
    $s = '<div class="custom-form">';

    foreach($previousanswer['data_collected'] as $category) {
        $fieldname = get_sanitized_name($category);
        $title = ucfirst($category);
        $s .=<<<EOM
<div class="fieldcontainer" id="$category">
<legend>$title</legend>
EOM;
        $s .= alpaca_field("{$fieldname}___shared", @$answer["{$fieldname}___shared"]);

        $s .=<<<EOM
</div>
EOM;
    }
    $s .= "</div>";
    return $s;

}

function customform_2_4_recap($answer, $previousanswer) {

    $s = '<div class="custom-form">';
    foreach($previousanswer['data_collected'] as $category) {
        $fieldname = get_sanitized_name($category);
        $title = ucfirst($category);
        $s .=<<<EOM
<div class="recap-fieldcontainer" id="$category">
<h3>$title</h3>
<ul class="box box-answer previous-answer recap-answer" data-field="{$fieldname}">
EOM;
        foreach($answer["{$fieldname}___shared"] as $value) {
            $s .= "<li>$value</li>\n";
        }

        $s .=<<<EOM
<ul>
</div>
EOM;
    }
    $s .= "</div>";
    return $s;

}

