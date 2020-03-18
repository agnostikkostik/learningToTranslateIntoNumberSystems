using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Web;

namespace KursovoyProekt
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void button1_MouseMove(object sender, MouseEventArgs e)
        {
            button1.BackColor = Color.Black;
        }

        private void button1_MouseLeave(object sender, EventArgs e)
        {
            button1.BackColor = Color.Transparent;
        }

        private void radioButton2_CheckedChanged(object sender, EventArgs e)
        {
            label1.Text = "Логин";
            label2.Text = "Пароль";
            label3.Visible = false;
            maskedTextBox1.Visible = false;
            textBox2.UseSystemPasswordChar = true;
        }

        private void radioButton1_CheckedChanged(object sender, EventArgs e)
        {
            label1.Text = "ФИО";
            label2.Text = "Группа";
            label3.Visible = true;
            maskedTextBox1.Visible = true;
            textBox2.UseSystemPasswordChar = false;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if ((textBox1.Text != "") && (textBox2.Text != ""))
            {
                if (radioButton1.Checked)
                {
                    webBrowser1.Navigate("http://ip-16-3.tk/API/Auth_S.php" +
                        "?login=" + HttpUtility.UrlEncode(textBox1.Text) +
                        "&group=" + HttpUtility.UrlEncode(textBox2.Text) +
                        "&id_P=" + HttpUtility.UrlEncode(maskedTextBox1.Text));
                }
                else
                {
                    webBrowser1.Navigate("http://ip-16-3.tk/API/Auth_P.php" +
                        "?login=" + HttpUtility.UrlEncode(textBox1.Text) +
                        "&password=" + HttpUtility.UrlEncode(textBox2.Text));
                }
            }
                
        }

        private void webBrowser1_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
            string answer_API = webBrowser1.DocumentText;

            String[] lines = answer_API.Split(';');
            if (radioButton1.Checked)
            {
                String[] temp = lines[0].Split('=');
                Student frm = new Student(Convert.ToInt32(temp[1]));
                frm.Show();
                this.Hide();
            }
            else
            {
                String[] temp1 = lines[0].Split('=');
                String[] temp2 = lines[1].Split('=');
                Teacher frm = new Teacher(Convert.ToInt32(temp1[1]), temp2[1]);
                frm.Show();
                this.Hide();
            }
        }

        private Point mouseOffset;
        private bool isMouseDown = false;
        private void pictureBox2_MouseDown(object sender, MouseEventArgs e)
        {
            int xOffset;
            int yOffset;

            if (e.Button == MouseButtons.Left)
            {
                xOffset = -e.X - SystemInformation.FrameBorderSize.Width;
                yOffset = -e.Y - SystemInformation.CaptionHeight -
                    SystemInformation.FrameBorderSize.Height;
                mouseOffset = new Point(xOffset, yOffset);
                isMouseDown = true;
            }
        }

        private void pictureBox2_MouseMove(object sender, MouseEventArgs e)
        {
            if (isMouseDown)
            {
                Point mousePos = Control.MousePosition;
                mousePos.Offset(mouseOffset.X, mouseOffset.Y);
                Location = mousePos;
            }
        }

        private void pictureBox2_MouseUp(object sender, MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                isMouseDown = false;
            }
        }
    }
}
