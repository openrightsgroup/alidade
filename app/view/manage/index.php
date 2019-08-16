<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Content</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="/manage/import" class="btn btn-default">Import Content</a>
            <a href="/manage/export" class="btn btn-default">Export Content</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <h2>Pages</h2>
            <ul class="object-list">
                <?php foreach ( $pages as $page ){ ?>
                <li>
                    <a href="/manage/page/<?php echo $page->idpages; ?>"><?php echo $page->title; ?></a>
                </li>
                <?php  } ?>
            </ul>
            <h2>Steps</h2>
            <ul class="object-list">
                <?php foreach ( $steps as $step ){ ?>
                <li>
                    <a href="/manage/step/<?php echo $step->idsteps; ?>"><?php echo $step->title; ?></a>
                    <span class="movelinks">
                        [<a href="/manage/stepup/<?php echo $step->idsteps ?>">Up</a>]
                        [<a href="/manage/stepdown/<?php echo $step->idsteps ?>">Down</a>]
                    </span>
                </li>
                <?php  } ?>
            </ul>
            <div><a href="/manage/step/new">Add new step</a></div>
        </div>
        
        <div class="col-md-5" id="manage-slide-list">
            <h2>Slides</h2>
            <?php $last = null; ?>
            
            <?php foreach ( $slides as $slide ){ ?>
                <?php if ($slide->step != $last) { ?>
                    <?php if ($last != null) { ?>
            </ul>
                    <?php } ?>
            <h3>Step <?php echo $slide->step ?> <small>[<a class="expander-link" href="#">Expand</a>]</small>  </h3>
            <ul class="object-list hidden">
                <?php $last = $slide->step; } ?>
                <li>
                    <?php echo $slide->step . '.' . $slide->position; ?> <a href="/manage/slide/<?php echo $slide->step; ?>/<?php echo $slide->position; ?>"><?php echo $slide->title; ?></a>
                    <span class="movelinks">
                    [<a href="/manage/slideup/<?php echo $slide->idslide_list ?>">Up</a>]
                    [<a href="/manage/slidedown/<?php echo $slide->idslide_list ?>">Down</a>]
                    </span>
                </li>
            <?php  } ?>
            </ul>
        </div>
        
    </div>
</div>

