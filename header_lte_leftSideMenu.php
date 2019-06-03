                        <aside class="main-sidebar">
<!-- Sidebar user panel -->
      <!-- /.search form -->
                          <!-- sidebar: style can be found in sidebar.less -->
                          <section class="sidebar">
                            <!-- Sidebar Menu -->
                            <ul class="sidebar-menu" data-widget="tree">
                              <?php
                              /* accessible tables */
                              
                              $arrTables = get_tables_info();
                              $homeLinks=[];
                              @include("{$currDir}/hooks/links-home.php"); 
                              if(is_array($arrTables) && count($arrTables)){
                                  /* how many table groups do we have? */
                                  $groups = get_table_groups();
                                  $multiple_groups = (count($groups) > 1 ? true : false);

                                  /* construct $tg: table list grouped by table group */
                                  $tg = array();
                                  if(count($groups)){
                                          foreach($groups as $grp => $tables){
                                                  foreach($tables as $tn){
                                                          $tg[$tn] = $grp;
                                                          if ($tn === $x->TableName) {
                                                              $current_group = $grp;
                                                          }
                                                  }
                                          }
                                  }

                                $i = 0; 
                                if (isset($ico_menu)){
                                    $json = json_decode($ico_menu,true);
                                }
                                $ico = "fa fa-table"; //default ico
                                $len = 17;
                                  foreach ($groups as $lte_group => $lte_tables) {
                                      if (($lte_group !== 'hiddens' || $memberInfo['admin']) ){ // new fucntionality if table group named hiddens dont show in other users
                                        if (count($lte_tables)){
                                            if (($lte_group !== 'None') ){
                                                ?>
                                                    <li class="treeview <?php echo ($lte_group === $current_group ? 'active' : '');?>">
                                                        <a href="#"><i class="<?php echo $json[$lte_group] ? $json[$lte_group] : $ico; ?>"></i> <span><?php echo $lte_group; ?></span>
                                                            <span class="pull-right-container">
                                                            <i class="fa fa-angle-left pull-right"></i>
                                                            </span>
                                                        </a>
                                                        <ul class="treeview-menu">
                                                            <?php
                                            }   
                                                                    foreach ($lte_tables as $lte_table){
                                                                        $tc = $arrTables[$lte_table];
                                                                        $count_badge ='';
                                                                        if($tc['homepageShowCount']){
                                                                            $sql_from = get_sql_from($lte_table);
                                                                            $count_records = ($sql_from ? sqlValue("select count(1) from " . $sql_from) : 0);
                                                                            $count_badge = '<small class="label pull-right bg-green">' . number_format($count_records) . '</small>';
                                                                        }
                                                                        /* hide current table in homepage? */
                                                                        $tChkHL = array_search($lte_table, array('ordersDetails','creditDocument','_resumeOrders', 'electronicInvoice','modalitaPagamento','codiceDestinatario','regimeFiscale','tipoCassa'));
                                                                        if($tChkHL === false || $tChkHL === null){ /* if table is not set as hidden in homepage */ ?>
                                                                            <li class ="<?php echo ($lte_table === $x->TableName ? 'active' : ''); ?>">
                                                                                <a href="<?php echo $lte_table; ?>_view.php">
                                                                                    <?php echo ($tc['tableIcon'] ? '<img src="' . $tc['tableIcon'] . '">' : '');?>
                                                                                    <strong class="table-caption">
                                                                                        <?php 
                                                                                            $dot = (strlen($tc['Caption']) > $len) ? "..." : "";
                                                                                            echo substr($tc['Caption'],0,$len).$dot; 
                                                                                        ?>
                                                                                    </strong>
                                                                                    <?php echo $count_badge; ?>
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    foreach($homeLinks as $link){
                                                                        if(!isset($link['url']) || !isset($link['title'])) continue;
                                                                        if($lte_group != $link['table_group'] && $lte_group != '*') continue;
                                                                        if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])){
                                                                        $title = $link['subGroup'] ? $link['subGroup']." - ".$link['title'] : $link['title'];
                                                                        $dot = (strlen($title) > $len+3) ? "..." : "";
                                                                            ?>
                                                                            <li>
                                                                                <a href="<?php echo $link['url']; ?>" title="<?php echo $title; ?>">
                                                                                    <?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?>
                                                                                    <?php echo substr($title,0,$len + 3).$dot; ?>
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    if (($lte_group !== 'None') ){
                                                            ?>

                                                        </ul>
                                                    </li>
                                                <?php
                                                                    }
                                                $i ++;
                                        }else{
                                            ?>
                                            <li class="active"><a href="#"><i class="fa fa-link"></i> <span><?php echo $lte_group; ?></span></a></li>

                                            <?php
                                        }
                                      }
                                  }
                                  foreach($homeLinks as $link){
                                      if(!isset($link['url']) || !isset($link['title'])) continue;
                                      if($link['table_group'] != '*' && $link['table_group'] != '') continue;
                                      if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])){
                                          ?>
                                          <li>
                                              <a href="<?php echo $link['url']; ?>">
                                                  <?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?>
                                                  <?php echo $link['subGroup'] ? $link['subGroup']." - ".$link['title'] : $link['title']; ?>
                                              </a>
                                          </li>
                                          <?php
                                      }
                                  }
                              }else{
                                      ?><script>window.location='index.php?signIn=1';</script><?php
                              }
                              ?>

                            </ul>
                            <!-- /.sidebar-menu -->
                          </section>
                          <!-- /.sidebar -->
                        </aside>
