require 'spec_helper'

describe package('postgresql') do
  it { should be_installed }
end

describe package('postgresql-client') do
  it { should be_installed }
end

describe package('postgresql-contrib') do
  it { should be_installed }
end

describe file('/etc/postgresql/9.3/main/postgresql.conf') do
  it { should be_file }
  it { should contain "listen_addresses='*'" }
end
