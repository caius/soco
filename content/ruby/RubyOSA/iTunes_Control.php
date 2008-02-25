<h2>iTunes Control Script</h2>

<p>Well it doesn't really control iTunes, just checks that its running, whether its playing, and then 
returns the name, artist and (if it exists) album names in a string.</p>

<?php

$l = "ruby";
$s = <<<EOF
# 
#  iTunes Xchat script
#  Returns your currently playing song to Xchat
#  
#  Created by Caius Durling <dev at caius dot name> on 2007-08-11.
#  Copyright 2007 Hentan Software.
#  Licenced under the Creative Commons Attribution-NonCommercial-ShareAlike 2.0 License.
#  
# 

require 'rubygems'
require 'rbosa'

if OSA.app("System Events").application_processes.every(:name).include?("iTunes")
  a = OSA.app("iTunes")
  if a.player_state.to_s == "playing"
    s = a.current_track
    result = "Now Playing: #{s.artist}"
    result += " - #{s.name}"
    result += " (Album: #{s.album})" if s.album #exists
    p result
  end
end
EOF;
$this->geshi->render($s, $l);
?>
