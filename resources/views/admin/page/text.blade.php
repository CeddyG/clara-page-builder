{!! BootForm::text(__('page.title_page'), 'page_text['.$iIdView.'][title_page]') !!}
{!! BootForm::text(__('page.url_page'), 'page_text['.$iIdView.'][url_page]') !!}
{!! BootForm::textarea(__('pag.content_page'), 'page_text['.$iIdView.'][content_page]')->addClass('ckeditor') !!}
{!! BootForm::textarea(__('page.description_page'), 'page_text['.$iIdView.'][description_page]') !!}
{!! BootForm::textarea(__('page.css_page'), 'page_text['.$iIdView.'][css_page]') !!}
{!! BootForm::textarea(__('page.js_page'), 'page_text['.$iIdView.'][js_page]') !!}