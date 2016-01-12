<div>
    <?php if ($pagingBlock = $this->fetch('paging')): ?>
        <?php echo $pagingBlock; ?>
    <?php else: ?>
        <?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
            <ul class="pagination">
                <li><?php echo $this->Paginator->first('< ' . __('First')); ?></li>
                <li><?php echo $this->Paginator->prev('< ' . __('Previous')); ?></li>
                <li><?php echo $this->Paginator->numbers( array( 'separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li' ) ); ?></li>
                <li><?php echo $this->Paginator->next(__('Next') . ' >'); ?></li>
                <li><?php echo $this->Paginator->last(__('Last') . ' >'); ?></li>
            </ul>
            <div class="counter">
            <?php 
                $project_page = (!empty($project_page)) ? $project_page : 0;                
                
                if($project_page == 0) {
                    echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting from record %start%, ending on %end%')));
                }
            ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>