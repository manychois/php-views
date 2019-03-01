<?php
namespace Manychois\Views\Tests;

use Manychois\Views\View;

class MasterView extends View
{

    #region Manychois\Views\View Members

    /**
     * Outputs the content of this view.
     */
    public function renderContent()
    {
        $vm = $this->getViewModel();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        <?php echo $vm->title; ?>
    </title>
    <?php $this->section('head', true);?>
</head>
<body>
    <main>
        <?php
        if ($this->hasChild()) {
            $this->content();
        } else {
            echo 'No content';
        }
		?>
    </main>
    <?php
        if ($this->hasChildSection('scripts')) {
            $this->section('scripts');
        } else {
            echo '<!-- No JavaScript -->';
        }
	?>
</body>
</html>
<?php
    }

    #endregion

    private function getViewModel() : ViewModel {
        return $this->model;
    }
}