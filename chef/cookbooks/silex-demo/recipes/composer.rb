execute "getcomposer" do
    user "vagrant"
    cwd "/home/vagrant"
    command "curl -sS https://getcomposer.org/installer | php"
    not_if do ::File.exists?("/usr/local/bin/composer") end
end

execute "mvcomposer" do
    user "root"
    command "mv /home/vagrant/composer.phar /usr/local/bin/composer"
    not_if do ::File.exists?("/usr/local/bin/composer") end
end
