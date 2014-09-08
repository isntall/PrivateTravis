require 'spec_helper'

describe file('/start.sh') do
  it { should be_file }
end
