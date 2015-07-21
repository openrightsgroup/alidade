<?php
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.03' . DS . 'html2pdf.class.php');
    
    class PrinterController extends Controller {
        
        public function output($project, $step){
            $Project = new Project;
            $Slide = new Slide;
            
            $data = $Project->findProject($project);
            
            
            
            //dbga($data);
            
            $steps = array();
            foreach($data['slides'] as $slide){
                if($slide->step == $step) {
                    $steps[] = $slide;
                }
            }
            
            $content = '
                        
                        <style type="text/css">
                        <!--
                            h3 {background: #e3e3e3;  padding:5mm 8mm;  font-weight: bold; width: 100%;   }
                            p {background: #FFFFFF;  padding:3mm; }
                        -->
                        </style>
                        <page>
                        <h1>' . $data['title'] . '</h1>';
                            
            
            
            
            switch($step){
                case 1:
                    
                    $thisSlide = $Slide->findSlide($project, $step, 3);
                    //dbga($thisSlide);
                    $content .= '   <h3>Description of the project:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>How a technology tool will help achieve the projects objective:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '<h3>Type of users:</h3>
                                    <p>' .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    '</p>';
                    $content .= '<h3>Will any of the users be people that you have not engaged with before?</h3>
                                    <p>' .
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $content .= '<h3>Areas where more research is needed:</h3>
                                    <p>' . nl2br($thisSlide->answer) . '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '<h3>Type of users:</h3>
                                    <p>' .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    '</p>';
                    
                    
                    
                    $thisSlide = $Slide->findSlide($project, $step, 7);            
                    
                    $content .= '   <h3>Need for user research:</h3>
                                    <p>' . (empty($thisSlide) ? 'I am already confident that I know how people will use the tool ' : 'I am conducting research into my users\' needs.' ) . '</p>';
                    
                    $content .= '   <h3>Who might use the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 8);            
                    $content .= '   <h3>Why users might be interested in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 9);            
                    $content .= '   <h3>Potential users\' experience in using this type of tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 10);            
                    $content .= '   <h3>Factors that could prevent or deter users from using the tool:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    
                                                
                    break;
                case 2:
                    
                    $thisSlide = $Slide->findSlide($project, $step, 2);            
                    $content .= '   <h3>What things the tool must be able to do:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 3);            
                    $content .= '   <h3>Existing tools that have these functions:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>Other projects that have used these kinds of tools for similar purposes:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 6);            
                    $content .= '   <h3>Decision to use an existing tool, adapt an existing tool or build a new tool</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    break;
                case 3:
                    $thisSlide = $Slide->findSlide($project, $step, 4);            
                    $content .= '   <h3>Methods for trialling the tool(s):</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    
                    $thisSlide = $Slide->findSlide($project, $step, 5);            
                    $content .= '   <h3>Results from trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';
                    $thisSlide = $Slide->findSlide($project, $step, 6);            
                    $content .= '   <h3>Steps (if any) to be taken following trial:</h3>
                                    <p>' .
                                    nl2br($thisSlide->answer) .
                                    (is_null($thisSlide->choice) ? '' : '<br /> ' . $thisSlide->choice) . 
                                    (is_null($thisSlide->extra) ? '' : nl2br($thisSlide->extra)) . 
                                    '</p>';                        
                    break;
                case 4:
                    
                    break;
            }
            
                        
            $content .= '</page>';
            //echo $content;
            
            $html2pdf = new HTML2PDF('P','A4','en');
            $html2pdf->WriteHTML($content);
            $html2pdf->Output('TSA-Step-' . $step . '.pdf');
            
        }    
        
    }
    