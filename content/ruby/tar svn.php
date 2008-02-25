<h2>SVN to Tar archive.rb</h2>

<?php

$source = <<<EOF
# 
#  tar_svn.rb
#  Tars a svn co
#  
#  Created by Caius Durling <dev at caius dot name> on 2007-06-19.
#  Copyright 2007 Hentan Software.
#  Licenced under the Creative Commons Attribution-NonCommercial-ShareAlike 2.0 License.
#  
# 
require 'ftools'

# If you pass URL PATH on the command line, then it uses them.
unless ARGV[0]
  puts "USAGE: tar_svn «url» «path» «version»"
  exit 0
end

@config = {
  :url => ARGV[0].to_s,
  :path => ARGV[1].to_s,
  :version => ARGV[2].to_s,
  :keep_checkout => false
}

# Post config processing
@config[:path] = File.expand_path(@config[:path])
@config[:folder] = @config[:url].split("/").last
@config[:svn] = `which svn`.strip
@config[:tar] = `which tar`.strip

raise "Please make sure svn is in the path" if @config[:svn].include?("no svn in")
raise "Please make sure tar is in the path" if @config[:tar].include?("no tar in")

# Make sure theres a / on the end of the path
@config[:path] += "/" unless @config[:path].split("").last == "/"
folder = @config[:path] + @config[:folder]

unless File.directory?(folder)
  p "Checking out svn"
  # SVN checkout doesn't exist
  `#{@config[:svn]} checkout #{@config[:url]} #{folder}`
  svn_checked_out = true
  p "Svn checkout finished"
end

unless svn_checked_out
  p "Updating svn"
  `#{@config[:svn]} update #{folder}`
  p "Update complete"
end

if File.directory?("#{folder}/trunk")
  Dir.new("#{folder}/trunk").each do |item|
    next if item =~ /^\.+/
    File::move("#{folder}/trunk/#{item}", "#{folder}/#{item}")
  end
end

p "Tarring file"
`cd #{@config[:path]} && #{@config[:tar]} -jcf #{@config[:folder]}_#{@config[:version]}.tar #{@config[:folder]}`
p "File tarred"
p "Cleaning up"
`rm -rf #{folder}`
`#{@config[:svn]} checkout #{@config[:url]} #{folder}` if @config[:keep_checkout]

p "Finished!"
EOF;
$lang = "ruby";
$cap = "tar_svn.rb";
$this->geshi->Render($source, $lang, $cap);
?>