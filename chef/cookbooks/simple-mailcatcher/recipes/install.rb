package 'build-essential'
package 'libsqlite3-dev'

chef_gem 'mailcatcher' do
  compile_time false
  version node['mailcatcher']['version']
end
