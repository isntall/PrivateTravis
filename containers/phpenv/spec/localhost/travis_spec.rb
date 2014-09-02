require 'spec_helper'

describe package('travis') do
  it { should be_installed.by('gem') }
end

describe file('/home/travis/.travis/travis-build') do
  it { should be_directory }
end
