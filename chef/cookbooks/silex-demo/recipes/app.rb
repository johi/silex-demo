directory '/srv/silex-demo/app' do 
    owner 'vagrant'
    group 'vagrant'
    mode '0755'
    action :create
    recursive true
end

service 'apache2' do
    action :stop
end

template 'nginx-silex-demo' do
  path '/etc/nginx/sites-available/nginx-silex-demo'
  source 'nginx-silex-demo.erb'
  owner 'root'
  group 'root'
  mode 0644
end

link '/etc/nginx/sites-enabled/nginx-silex-demo' do
  to '/etc/nginx/sites-available/nginx-silex-demo'
  action :create
end

link '/etc/nginx/sites-enabled/default' do
  action :delete
end

service 'nginx' do
    action [:stop, :start]
end

execute 'composer-update' do
    cwd '/srv/silex-demo/app'
    command 'composer update'
end
