import { AutoelectPage } from './app.po';

describe('autoelect App', function() {
  let page: AutoelectPage;

  beforeEach(() => {
    page = new AutoelectPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
