<ul>
    <?php
    if (is_array($userFAQ) && !empty($userFAQ)) {
        foreach ($userFAQ as $faq) {
            ?>
            <li>
                <strong><?php echo $faq['R']['question'];?></strong>
                <div class="faq-content">
                    <p><?php echo $faq['R']['answer'];?></p>
                </div>
            </li>
            <?php
        }
    }
    ?>
    
</ul>