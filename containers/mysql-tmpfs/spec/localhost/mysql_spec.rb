require 'spec_helper'

describe package('mysql-server') do
  it { should be_installed }
end

describe file('/etc/mysql/my.cnf') do
  it { should be_file }
  it { should contain '# bind-address' }
end

describe file('/start.sh') do
  it { should be_file }
end
