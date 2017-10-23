<?php
echo "lol";
                            $data = Controller::getData();
                            $text_message = array_reverse($data['chat']['messages']);
                            foreach ($text_message as $key => $value) {
                                if (verMemberInChat(addslashes((string)$text_message[$key]['nickname']))) {
                                    echo '<span class="admin_chat_message">'.htmlspecialchars($text_message[$key]['nickname']).':</span> '.htmlspecialchars($text_message[$key]['message']).'<br>';
                                }else{
                                    echo htmlspecialchars($text_message[$key]['nickname']).': '.htmlspecialchars($text_message[$key]['message']).'<br>';
                                }
                            }
                        ?>