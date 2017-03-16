user 'mailcatcher user' do
  username node['mailcatcher']['user']
  comment 'MailCatcher User'
  home "#{node['mailcatcher']['dir']}/mailcatcher"
  shell '/bin/bash'
  supports manage_home: true
  action :create
  system true
end

group 'mailcatcher group' do
  group_name node['mailcatcher']['group']
  action :create
  system true
end
