/**
 * @copyright  (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
(() => {
  /**
    * Javascript to insert the link
    * View element calls jSelectArticle when an article is clicked
    * jSelectArticle creates the link tag, sends it to the editor,
    * and closes the select frame.
    * */

  window.jSelectArticle = (id, title) => {
    let hreflang = '';

    if (!Joomla.getOptions('xtd-issues')) {
      // Something went wrong!
      // @TODO Close the modal
      return false;
    }

    const {
      editor
    } = Joomla.getOptions('xtd-issues');


    const tag = `<a ${hreflang}>${title}</a>`;
    window.parent.Joomla.editors.instances[editor].replaceSelection(tag);

    if (window.parent.Joomla.Modal) {
      window.parent.Joomla.Modal.getCurrent().close();
    }

    return true;
  };

  document.addEventListener('DOMContentLoaded', () => {
    // Get the elements
    const elements = document.querySelectorAll('.select-link');

    for (let i = 0, l = elements.length; l > i; i += 1) {
      // Listen for click event
      elements[i].addEventListener('click', event => {
        event.preventDefault();
        const {
          target
        } = event;
        const functionName = target.getAttribute('data-function');

        if (functionName === 'jSelectIssue') {
          // Used in xtd_contacts
          window[functionName](target.getAttribute('data-id'), target.getAttribute('data-title'));
        } else {
          // Used in com_menus
          window.parent[functionName](target.getAttribute('data-id'), target.getAttribute('data-title'));
        }

        if (window.parent.Joomla.Modal) {
          window.parent.Joomla.Modal.getCurrent().close();
        }
      });
    }
  });
})();
