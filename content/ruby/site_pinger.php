<h2>Site Pinger.rb</h2>

<?php

$code = <<<EOF
#!/usr/bin/env ruby

# 
#  SitePinger.rb
#  Pings a list of sites
#  
#  Created by Caius Durling <dev at caius dot name> on 2007-07-16.
#  Copyright 2007 Hentan Software.
#  Licenced under the Creative Commons Attribution-NonCommercial-ShareAlike 2.0 License.
#  
#  For Mellertime
#  Note: Remember that the last thing passed in a ruby block gets returned without specifying return
# 

# Require some standard libraries
require 'net/http'
require 'uri'

# I'm lazy, lets add a method to the integer class to save typing later on.
class Integer
  def lines
    # Inserts self blank lines
    self.times { puts }
  end
end

class PingWebsites
  def initialize(urls)
    @urls = urls
    @status = Array.new
  end
  
  def render()
    @urls.each do |url|
      status = get_url(url)
      @status << status
      puts "#{url}\t#{status}"
    end
  end

# Anything below here is private
private
  # Guts of the script
  def get_url(url, limit = 10)
    # Find a website with less errors, its redirected 10 times, so we just throw an error and end the 
program
    raise ArgumentError, "HTTP redirect is too deep for #{url}" if limit == 0

    begin
      # Talk to the website using Net::HTTP & get the response
      response = Net::HTTP.get_response(URI.parse(url))
    rescue Exception => e
      return "Failed\tWebsite Doesn't Exist"
    end
    
    # Flick through some outcomes, then catch it with a "Failed"
    case response
    when Net::HTTPSuccess then "Success\t#{response.code}"
    when Net::HTTPRedirection then get_url(response['location'], limit-1)
    else
      "Failed\t#{response.code}"
    end
  end
end

# How to use
# From another ruby script requires the next line, otherwise delete it
# require 'SitePinger'

domains = [
  "http://caius.name",
  "http://hentan.eu",
  "http://swedishcampground.com/",
  "http://google.com"
  ]

a = PingWebsites.new(domains)
a.render
EOF;
$lang = "ruby";

$this->geshi->Render($code, $lang);
?>
