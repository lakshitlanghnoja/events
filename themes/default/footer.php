                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($ci->config->item('benchmark') == 1): ?>
            <? $ci->output->enable_profiler(TRUE); ?>
        <?php endif; ?>
        <div class="footer">
            Copyright © <?php echo date('Y');?> Company Name. All rights reserved.
        </div>
    </div>
</body>

</html>