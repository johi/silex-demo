%w( user install service_init ).each do |r|
  include_recipe "#{cookbook_name}::#{r}"
end
