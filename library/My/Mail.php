<?php
class My_Mail
{
	// templates name


	protected $_viewSubject;
	protected $_viewContent;
	protected $templateVariables = array();
	protected $templateName;
	protected $_mail;
	protected $recipient;

	public function __construct()
	{
		$this->_mail = new Zend_Mail('utf-8');
		$this->_viewSubject = new Zend_View();
		$this->_viewContent = new Zend_View();
	}

	/**
	 * Set variables for use in the templates
	 *
	 * @param string $name The name of the variable to be stored
	 * @param mixed $value The value of the variable
	 */
	public function __set($name, $value)
	{
		$this->templateVariables[$name] = $value;
	}

	/**
	 * Set the template file to use
	 *
	 * @param string $filename Template filename
	 */
	public function setTemplate($filename)
	{
		$this->templateName = $filename;
	}

	/**
	 * Set the recipient address for the email message
	 *
	 * @param string $email Email address
	 */
	public function setRecipient($email)
	{
		$this->recipient = $email;
	}

	/**
	 * Send email
	 *
	 * @todo Add from name
	 */
	public function send()
	{

		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');

		$templatePath = $config->production->email->templatePath;
		$templateVars = $config->production->resources->mail->toArray();

		foreach ($templateVars as $key => $value) {
			if (!array_key_exists($key, $this->templateVariables)) {
				$this->{$key} = $value;
			}
		}

		$viewContent = realpath($templatePath) . DIRECTORY_SEPARATOR . $this->templateName . '.subj.tpl';
		$stringSubject = file_get_contents($viewContent);
		$subject = vsprintf($stringSubject, $this->templateVariables);

		$viewContent = realpath($templatePath) . DIRECTORY_SEPARATOR . $this->templateName . '.tpl';
		$stringMail = file_get_contents($viewContent);
		$html = vsprintf($stringMail, $this->templateVariables);

		$this->_mail->addTo($this->recipient);
		$this->_mail->setSubject($subject);
		$this->_mail->setBodyHtml($html);
		$this->_mail->send();

	}
}