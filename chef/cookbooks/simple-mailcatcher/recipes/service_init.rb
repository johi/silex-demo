template '/etc/init.d/mailcatcher' do
  source 'mailcatcher.init.erb'
  mode '0755'

  notifies :restart, 'service[mailcatcher]'
end

service 'mailcatcher' do
  supports restart: true, status: true

  action [:enable, :start]
end
