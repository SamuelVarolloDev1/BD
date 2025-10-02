using MySql.Data.MySqlClient;

namespace Banco_de_Dados
{
    public partial class Form1 : Form
    {
        static public MySqlConnection oConexao = new MySqlConnection();

        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            oConexao.ConnectionString = "Server=192.168.0.12; uid=Aluno2DS; pwd=SenhaBD2; Database=BANCO2DS";
            oConexao.Open();

            MessageBox.Show("Abrido");
        }

        private void Categoria_Click(object sender, EventArgs e)
        {
            new FRMCategoria().ShowDialog();
        }
    }
}