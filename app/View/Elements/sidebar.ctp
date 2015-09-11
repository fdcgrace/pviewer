<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
        
        	  <p class="centered"><a href="profile.html"><img src="<?php echo $this->base; ?>/assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
        	  <h5 class="centered">Admin</h5>
        	  	
            <li class="mt">
                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-dashboard')).$this->Html->tag('span','Dashboard'), 
                      array('controller' => 'pages', 'action' => 'display'), array('escape' => false));?>
            </li>

            <li class="sub-menu">
                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-desktop')).$this->Html->tag('span','Projects'), 
                    "javascript:;", array('escape' => false));?>
                <ul class="sub">
                  <li><?php echo $this->Html->link(__('View Projects'), array('controller' => 'projects', 'action' => 'index'));?></li>
                  <li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?></li>
                </ul>
            </li>

            <li class="sub-menu">
                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-cogs')).$this->Html->tag('span','Teams'), 
                    "javascript:;", array('escape' => false));?>
                <ul class="sub">
                  <li><?php echo $this->Html->link(__('View Teams'), array('controller' => 'teams', 'action' => 'index'));?></li>
                </ul>
            </li>
            <li class="sub-menu">
                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-book')).$this->Html->tag('span','Members'), 
                    "javascript:;", array('escape' => false));?>
                <ul class="sub">
                  <li><?php echo $this->Html->link(__('View Members'), array('controller' => 'members', 'action' => 'index'));?></li>
                </ul>
            </li>
            <li class="sub-menu">
                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-tasks')).$this->Html->tag('span','Issues'), 
                    "javascript:;", array('escape' => false));?>
                <ul class="sub">
                  <li><?php echo $this->Html->link(__('View Issues'), array('controller' => 'pdetails', 'action' => 'index'));?></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->