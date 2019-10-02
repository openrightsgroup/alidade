<?php

include __DIR__ . "/../lib/functions.php";

use PHPUnit\Framework\TestCase;

class EditFieldTest extends TestCase {

    public function testAnswerField() {
        $output = injectAnswerField("stuff\n[--answer--]\nmore stuff", "answer");
        
        $this->assertSame($output, "stuff\n<textarea id=\"answer\" name=\"answer\" class=\"form-control\" rows=\"8\"></textarea>\nmore stuff");
    }

    public function testMultipleAnswer() {
        $origin = new stdClass();
        $origin->answer = '';
        $output = injectMultipleAnswerField("stuff\n[--multiple-answer-0--]\nsection\n[--multiple-answer-1--]\nmore stuff", "answer", $origin);
        
        $this->assertSame(
            $output,
            "stuff\n<textarea id=\"answer-0\" name=\"answer[0]\" class=\"form-control\" rows=\"8\"></textarea>\nsection\n<textarea id=\"answer-1\" name=\"answer[1]\" class=\"form-control\" rows=\"8\"></textarea>\nmore stuff"
            );

    }

    public function testBox() {
        $output = injectBox("stuff\n[--box|casestudy--]SomeText[--endbox--]\nmore stuff");
        
        $this->assertCount(2, $output);
        $this->assertSame($output['content'], "stuff\n\nmore stuff");
        $this->assertSame($output['boxes'][0], "<div class=\"box box-casestudy\"><h3>case study</h3>SomeText</div>");
        
    }
    
    public function testChoiceButton() {
        $output = injectChoiceButtons("stuff\n[--choicebutton|foo|Foo--]\nmore stuff");
        
        $this->assertSame(
            $output,
            "stuff\n<a href=\"#\" class=\"btn btn-alidade btn-lg picker\" data-target=\"#foo\">Foo</a>\nmore stuff"
        );
        
    }
    
    public function testChoicePanels() {
        $output = injectChoicePanels("stuff\n[--choicepanel|foo--]Some Stuff[--endchoicepanel--]\nmore stuff");
        
        $this->assertSame(
            $output,
            "stuff\n<div class=\"row hide picks\" id=\"foo\">Some Stuff</div>\nmore stuff"
        );
    }
    
    public function testRadioButtons() {
        $output = injectRadioButtons("stuff\n[--radio|foo|Foo--]\n[--radio|bar|Bar--]\nmore stuff");
        
        $this->assertSame(
            $output,
            "stuff\n<div class=\"radio\"><label><input id=\"choice-foo\" name=\"choice\" class=\"choice\" type=\"radio\" value=\"foo\"> Foo</label></div>
<div class=\"radio\"><label><input id=\"choice-bar\" name=\"choice\" class=\"choice\" type=\"radio\" value=\"bar\"> Bar</label></div>\nmore stuff"
        );
    }
    
    public function testCheckBoxes() {
        $output = injectCheckboxes("stuff\n[--check|opt1|My stuff--]\n[--check|opt2|Other stuff--]\nmore stuff");
        
        $this->assertSame(
            $output,
            "stuff
<div class=\"checkbox\"><input id=\"check-opt1\" name=\"opt1\" type=\"checkbox\" value=\"My stuff\"> My stuff</div>
<div class=\"checkbox\"><input id=\"check-opt2\" name=\"opt2\" type=\"checkbox\" value=\"Other stuff\"> Other stuff</div>
more stuff"
        );
    }
}
