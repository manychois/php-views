<?php
namespace Manychois\Views\Tests;

use Manychois\Views\View;

class ChildView extends View
{
    public function __construct()
    {
        $this->setParentView(new MasterView());
    }

    #region Manychois\Views\View Members

    public function renderContent()
    {
    ?>
<article>
    <h1>Hello World!</h1>
</article>
<?php
    }

    #endregion

       public function render_head()
       {
?>
<meta name="description" content="SEO is hard" />
<?php
       }
}