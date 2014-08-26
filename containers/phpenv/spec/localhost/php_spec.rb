require 'spec_helper'

describe package('php5-cli') do
  it { should be_installed }
end
